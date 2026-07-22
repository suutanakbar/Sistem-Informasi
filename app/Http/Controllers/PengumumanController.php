<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = Pengumuman::query()->with('pembuat');

        if ($user->isPengurusOrmada()) {
            // Pengurus: untuk sekarang lihat semua, nanti bisa dibatasi jika perlu
        } elseif ($user->isPemda()) {
            // Pemda: lihat semua
        }
        // Admin lihat semua

        $pengumumans = $query->latest('tanggal_publish')->latest('dibuat_pada')->paginate(12);

        $view = match(true) {
            $user->isPemda() => 'pemda.pengumuman.index',
            $user->isPengurusOrmada() => 'pengurus.pengumuman.index',
            default => 'admin.pengumuman.index',
        };

        return view($view, compact('pengumumans'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isAdmin() || $user->isPemda(), 403);

        $view = match(true) {
            $user->isPemda() => 'pemda.pengumuman.create',
            $user->isPengurusOrmada() => 'pengurus.pengumuman.create',
            default => 'admin.pengumuman.create',
        };

        return view($view);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isPengurusOrmada() || $user->isAdmin() || $user->isPemda(), 403);

        $validated = $this->validatePengumuman($request);

        // Auto set pembuat
        $validated['dibuat_oleh'] = $user->id;

        // Handle file upload
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('pengumuman', 'public');
        }

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengumuman', 'public');
        }

        $pengumuman = Pengumuman::create($validated);

        return redirect()
            ->route('pengumuman.index')
            ->with('status', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Request $request, Pengumuman $pengumuman): View
    {
        $user = $request->user();

        // Untuk publik/admin/petugas bisa lihat detail
        $view = $user ? match(true) {
            $user->isPemda() => 'pemda.pengumuman.show',
            $user->isPengurusOrmada() => 'pengurus.pengumuman.show',
            default => 'admin.pengumuman.show',
        } : 'public.pengumuman.show';

        return view($view, compact('pengumuman'));
    }

    public function edit(Request $request, Pengumuman $pengumuman): View
    {
        $user = $request->user();
        abort_unless($user->isAdmin() || $user->isPemda() || $user->isPengurusOrmada(), 403);

        $view = match(true) {
            $user->isPemda() => 'pemda.pengumuman.edit',
            $user->isPengurusOrmada() => 'pengurus.pengumuman.edit',
            default => 'admin.pengumuman.edit',
        };

        return view($view, compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isAdmin() || $user->isPemda() || $user->isPengurusOrmada(), 403);

        $validated = $this->validatePengumuman($request, $pengumuman);

        if ($request->hasFile('file')) {
            if ($pengumuman->file) {
                Storage::disk('public')->delete($pengumuman->file);
            }
            $validated['file'] = $request->file('file')->store('pengumuman', 'public');
        }

        if ($request->hasFile('foto')) {
            if ($pengumuman->foto) {
                Storage::disk('public')->delete($pengumuman->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengumuman', 'public');
        }

        $pengumuman->update($validated);

        return redirect()
            ->route('pengumuman.index')
            ->with('status', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Request $request, Pengumuman $pengumuman): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user->isAdmin() || $user->isPemda() || $user->isPengurusOrmada(), 403);

        if ($pengumuman->file) {
            Storage::disk('public')->delete($pengumuman->file);
        }
        if ($pengumuman->foto) {
            Storage::disk('public')->delete($pengumuman->foto);
        }

        $pengumuman->delete();

        return redirect()
            ->route('pengumuman.index')
            ->with('status', 'Pengumuman berhasil dihapus.');
    }

    private function validatePengumuman(Request $request, ?Pengumuman $pengumuman = null): array
    {
        $rules = [
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal_publish' => ['required', 'date'],
            'file' => [$pengumuman ? 'nullable' : 'nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
            'foto' => [$pengumuman ? 'nullable' : 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];

        return $request->validate($rules);
    }
}