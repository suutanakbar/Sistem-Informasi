<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AspirasiController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = Aspirasi::query()->with(['profilOrmada', 'profilOrmada.admin']);

        // Filter berdasarkan role
        if ($user->isPengurusOrmada()) {
            // Pengurus hanya melihat aspirasi dari profilnya
            $profil = $user->profilOrmada()->first();
            if (!$profil) {
                abort(403, 'Anda belum memiliki profil ormada');
            }
            $query->where('profil_ormada_id', $profil->id);
        } elseif ($user->isPemda()) {
            // Pemda melihat semua aspirasi
            // Bisa filter by status
            $status = $request->query('status');
            if ($status) {
                $query->where('status', $status);
            }
        }
        // Admin melihat semua

        $aspirasis = $query->latest('dibuat_pada')->paginate(12);

        $statusOptions = ['belum_ditanggapi', 'sedang_diproses', 'selesai', 'ditolak'];

        $view = match(true) {
            $user->isPemda() => 'pemda.aspirasi.index',
            $user->isPengurusOrmada() => 'pengurus.aspirasi.index',
            default => 'admin.aspirasi.index',
        };
        
        return view($view, compact('aspirasis', 'statusOptions'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

        $profilOrmadas = [];
        
        // Jika pengurus, ambil profil ormada-nya
        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();
            if (!$profil) {
                abort(403, 'Anda belum memiliki profil ormada');
            }
        } elseif ($user->isAdmin()) {
            // Ambil semua profil ormada untuk admin
            $profilOrmadas = \App\Models\ProfilOrmada::all();
        }

        $view = match(true) {
            $user->isPemda() => 'pemda.aspirasi.create',
            $user->isPengurusOrmada() => 'pengurus.aspirasi.create',
            default => 'admin.aspirasi.create',
        };
        
        return view($view, compact('profilOrmadas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

        $validated = $this->validateAspirasi($request, $user);
        
        // Set profil ormada (server-side, tidak percaya input client)
        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();
            if (!$profil) {
                return redirect()->route('aspirasi.create')->with('error', 'Anda belum memiliki profil ormada.');
            }
            $validated['profil_ormada_id'] = $profil->id;
        } else {
            // Admin: gunakan profil yang dipilih dari form
            $validated['profil_ormada_id'] = $validated['profil_ormada_id'];
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('aspirasi', 'public');
        }

        $aspirasi = Aspirasi::create($validated);

        return redirect()
            ->route('aspirasi.show', $aspirasi)
            ->with('status', 'Aspirasi berhasil diajukan.');
    }

    public function show(Request $request, Aspirasi $aspirasi): View
    {
        $user = $request->user();
        
        // Authorization
        $this->authorizeAspirasiAccess($user, $aspirasi);

        $aspirasi->load('profilOrmada', 'profilOrmada.admin');

        $view = match(true) {
            $user->isPemda() => 'pemda.aspirasi.show',
            $user->isPengurusOrmada() => 'pengurus.aspirasi.show',
            default => 'admin.aspirasi.show',
        };
        
        return view($view, compact('aspirasi'));
    }

    public function edit(Request $request, Aspirasi $aspirasi): View
    {
        $user = $request->user();
        
        // Hanya pemilik atau admin yang bisa edit
        abort_unless(
            $user->isAdmin() || 
            ($user->isPengurusOrmada() && $aspirasi->profil_ormada_id === $user->profilOrmada()->first()?->id),
            403
        );

        $view = match(true) {
            $user->isPemda() => 'pemda.aspirasi.edit',
            $user->isPengurusOrmada() => 'pengurus.aspirasi.edit',
            default => 'admin.aspirasi.edit',
        };
        
        return view($view, compact('aspirasi'));
    }

    public function update(Request $request, Aspirasi $aspirasi): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya pemilik atau admin yang bisa edit
        abort_unless(
            $user->isAdmin() || 
            ($user->isPengurusOrmada() && $aspirasi->profil_ormada_id === $user->profilOrmada()->first()?->id),
            403
        );

        $validated = $this->validateAspirasi($request, $user, $aspirasi);

        // Handle file upload
        if ($request->hasFile('file')) {
            if ($aspirasi->file) {
                Storage::disk('public')->delete($aspirasi->file);
            }
            $validated['file'] = $request->file('file')->store('aspirasi', 'public');
        }

        $aspirasi->update($validated);

        return redirect()
            ->route('aspirasi.show', $aspirasi)
            ->with('status', 'Aspirasi berhasil diperbarui.');
    }

    public function destroy(Request $request, Aspirasi $aspirasi): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('delete', $aspirasi);

        // Delete file if exists
        if ($aspirasi->file) {
            Storage::disk('public')->delete($aspirasi->file);
        }

        $aspirasi->delete();

        return redirect()
            ->route('aspirasi.index')
            ->with('status', 'Aspirasi berhasil dihapus.');
    }

    public function updateTanggapan(Request $request, Aspirasi $aspirasi): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa menanggapi
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $validated = $request->validate([
            'tanggapan_pemda' => ['required', 'string'],
            'status' => ['required', 'in:belum_ditanggapi,sedang_diproses,selesai,ditolak'],
        ]);

        $validated['tanggal_tanggapan'] = now();

        $aspirasi->update($validated);

        return back()->with('status', 'Tanggapan berhasil disimpan.');
    }

    private function validateAspirasi(Request $request, ?Admin $user = null, ?Aspirasi $aspirasi = null): array
    {
        $rules = [
            'topik_aspirasi' => ['required', 'string', 'max:255'],
            'detail_aspirasi' => ['required', 'string'],
            'file' => [$aspirasi ? 'nullable' : 'nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        ];

        // Admin harus memilih profil ormada saat create, tidak perlu saat update
        if ($user && $user->isAdmin() && !$aspirasi) {
            $rules['profil_ormada_id'] = ['required', 'exists:profil_ormada,id'];
        } else {
            $rules['profil_ormada_id'] = ['nullable', 'exists:profil_ormada,id'];
        }

        return $request->validate($rules);
    }

    private function authorizeAspirasiAccess(Admin $user, Aspirasi $aspirasi): void
    {
        $profilId = $aspirasi->profil_ormada_id;
        $userProfilId = $user->profilOrmada()->first()?->id;

        abort_unless(
            $user->isAdmin() ||
            $user->isPemda() ||
            ($user->isPengurusOrmada() && $profilId === $userProfilId),
            403
        );
    }
}