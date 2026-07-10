<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostinganController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = Postingan::query()->with('admin');

        // Filter berdasarkan role
        if ($user->isPengurusOrmada()) {
            // Pengurus hanya melihat postingan miliknya
            $query->where('admin_id', $user->id);
        } elseif ($user->isPemda()) {
            // Pemda melihat semua postingan
            // Bisa filter by jenis_konten
            $jenis = $request->query('jenis_konten');
            if ($jenis) {
                $query->where('jenis_konten', $jenis);
            }
        }
        // Admin melihat semua

        $postingans = $query->latest('dibuat_pada')->paginate(12);

        $jenisOptions = ['berita', 'pengumuman', 'prestasi'];

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.postingan.index';
        } elseif ($user->isPemda()) {
            $view = 'pemda.postingan.index';
        } else {
            $view = 'admin.postingan.index';
        }
        
        return view($view, compact('postingans', 'jenisOptions'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin(), 403);

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.postingan.create';
        } elseif ($user->isPemda()) {
            $view = 'pemda.postingan.create';
        } else {
            $view = 'admin.postingan.create';
        }
        
        return view($view);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin(), 403);

        $validated = $this->validatePostingan($request);
        
        // Set admin_id = user yang login
        $validated['admin_id'] = $user->id;

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('postingan/foto', 'public');
        }

        // Jika publish, set tanggal_publish
        if ($request->has('is_published') && $request->is_published) {
            $validated['is_published'] = true;
            $validated['tanggal_publish'] = now();
        } else {
            $validated['is_published'] = false;
            $validated['tanggal_publish'] = null;
        }

        $postingan = Postingan::create($validated);

        return redirect()
            ->route('postingan.index')
            ->with('status', 'Postingan berhasil dibuat.');
    }

    public function show(Request $request, Postingan $postingan): View
    {
        $user = $request->user();
        
        // Authorization
        $this->authorizePostinganAccess($user, $postingan);

        $postingan->load('admin');

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.postingan.show';
        } elseif ($user->isPemda()) {
            $view = 'pemda.postingan.show';
        } else {
            $view = 'admin.postingan.show';
        }
        
        return view($view, compact('postingan'));
    }

    public function edit(Request $request, Postingan $postingan): View
    {
        $user = $request->user();
        
        // Hanya pemilik atau admin/pemda yang bisa edit
        abort_unless(
            $user->isAdmin() || 
            $user->isPemda() || 
            ($user->isPengurusOrmada() && $postingan->admin_id === $user->id),
            403
        );

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.postingan.edit';
        } elseif ($user->isPemda()) {
            $view = 'pemda.postingan.edit';
        } else {
            $view = 'admin.postingan.edit';
        }
        
        return view($view, compact('postingan'));
    }

    public function update(Request $request, Postingan $postingan): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya pemilik atau admin/pemda yang bisa edit
        abort_unless(
            $user->isAdmin() || 
            $user->isPemda() || 
            ($user->isPengurusOrmada() && $postingan->admin_id === $user->id),
            403
        );

        $validated = $this->validatePostingan($request, $postingan);

        // Handle file upload
        if ($request->hasFile('foto')) {
            if ($postingan->foto) {
                Storage::disk('public')->delete($postingan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('postingan/foto', 'public');
        }

        // Jika publish, set tanggal_publish
        if ($request->has('is_published') && $request->is_published) {
            $validated['is_published'] = true;
            $validated['tanggal_publish'] = now();
        } else {
            $validated['is_published'] = false;
            $validated['tanggal_publish'] = null;
        }

        $postingan->update($validated);

        return redirect()
            ->route('postingan.show', $postingan)
            ->with('status', 'Postingan berhasil diperbarui.');
    }

    public function destroy(Request $request, Postingan $postingan): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('delete', $postingan);

        // Delete foto if exists
        if ($postingan->foto) {
            Storage::disk('public')->delete($postingan->foto);
        }

        $postingan->delete();

        return redirect()
            ->route('postingan.index')
            ->with('status', 'Postingan berhasil dihapus.');
    }

    public function publish(Request $request, Postingan $postingan): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa publish
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $postingan->update([
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        return back()->with('status', 'Postingan berhasil dipublish.');
    }

    private function validatePostingan(Request $request, ?Postingan $postingan = null): array
    {
        $rules = [
            'judul' => ['required', 'string', 'max:255'],
            'isi_konten' => ['required', 'string'],
            'jenis_konten' => ['required', 'in:berita,pengumuman,prestasi'],
            'foto' => [$postingan ? 'nullable' : 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        return $request->validate($rules);
    }

    private function authorizePostinganAccess($user, Postingan $postingan): void
    {
        // Admin dan Pemda bisa akses semua
        if ($user->isAdmin() || $user->isPemda()) {
            return;
        }

        // Pengurus bisa akses postingan miliknya
        if ($user->isPengurusOrmada() && $postingan->admin_id === $user->id) {
            return;
        }

        // Public hanya bisa lihat yang published
        if (!$user && $postingan->is_published) {
            return;
        }

        abort(403);
    }
}