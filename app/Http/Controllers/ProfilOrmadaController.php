<?php

namespace App\Http\Controllers;

use App\Models\ProfilOrmada;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilOrmadaController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();

            return $profil
                ? redirect()->route('profil-ormada.show', $profil)
                : redirect()->route('profil-ormada.create');
        }

        $profilOrmadas = ProfilOrmada::query()
            ->with('admin')
            ->withCount([
                'anggota',
                'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
            ])
            ->latest('dibuat_pada')
            ->paginate(12);

        if ($user->isPemda()) {
            return view('pemda.profil_ormada.index', compact('profilOrmadas'));
        }

        return view('profil_ormada.index', compact('profilOrmadas'));
    }

    public function create(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        $profil = $user->profilOrmada()->first();

        if ($user->isPengurusOrmada() && $profil) {
            return redirect()->route('profil-ormada.edit', $profil);
        }

        if ($user->isAdmin()) {
            return view('profil_ormada.create');
        }

        return view('pengurus.profil_ormada.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);
        abort_if($user->isPengurusOrmada() && $user->profilOrmada()->exists(), 403);

        $validated = $this->validateProfil($request);
        $validated['admin_id'] = $user->id;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('profil-ormada/logo', 'public');
        }

        $profilOrmada = ProfilOrmada::create($validated);

        return redirect()
            ->route('profil-ormada.show', $profilOrmada)
            ->with('status', 'Profil ormada berhasil dibuat.');
    }

    public function show(Request $request, ProfilOrmada $profilOrmada): View
    {
        $this->authorizeProfilAccess($request, $profilOrmada);

        $profilOrmada->load('admin')->loadCount([
            'anggota',
            'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
        ]);

        $anggotaRingkas = $profilOrmada->anggota()
            ->latest('dibuat_pada')
            ->limit(8)
            ->get();

        // Load all anggota for management tab
        $search = $request->string('search')->toString();
        $statusAktif = $request->string('status_aktif')->toString();
        $isPengurus = $request->string('is_pengurus')->toString();

        $anggotaQuery = $profilOrmada->anggota()
            ->search($search)
            ->when($statusAktif, fn ($query) => $query->where('status_aktif', $statusAktif))
            ->when($isPengurus, fn ($query) => $query->where('is_pengurus', $isPengurus));

        $anggotaList = $anggotaQuery->latest('dibuat_pada')->paginate(15)->withQueryString();

        $user = $request->user();
        
        if ($user->isPemda()) {
            return view('pemda.profil_ormada.show', compact('profilOrmada', 'anggotaRingkas', 'anggotaList'));
        } elseif ($user->isPengurusOrmada()) {
            return view('pengurus.profil_ormada.show', compact('profilOrmada', 'anggotaRingkas', 'anggotaList'));
        }

        return view('profil_ormada.show', compact('profilOrmada', 'anggotaRingkas', 'anggotaList'));
    }

    public function edit(Request $request, ProfilOrmada $profilOrmada): View
    {
        $this->authorizeProfilMutation($request, $profilOrmada);

        $user = $request->user();
        
        if ($user->isPengurusOrmada()) {
            return view('pengurus.profil_ormada.edit', compact('profilOrmada'));
        }

        return view('profil_ormada.edit', compact('profilOrmada'));
    }

    public function update(Request $request, ProfilOrmada $profilOrmada): RedirectResponse
    {
        $this->authorizeProfilMutation($request, $profilOrmada);

        $validated = $this->validateProfil($request);

        if ($request->hasFile('logo')) {
            if ($profilOrmada->logo) {
                Storage::disk('public')->delete($profilOrmada->logo);
            }

            $validated['logo'] = $request->file('logo')->store('profil-ormada/logo', 'public');
        }

        $profilOrmada->update($validated);

        return redirect()
            ->route('profil-ormada.show', $profilOrmada)
            ->with('status', 'Profil ormada berhasil diperbarui.');
    }

    private function validateProfil(Request $request): array
    {
        return $request->validate([
            'nama_universitas' => ['required', 'string', 'max:255'],
            'alamat_universitas' => ['required', 'string', 'max:255'],
            'total_mahasiswa_univ' => ['nullable', 'integer', 'min:0'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ]);
    }

    private function authorizeProfilAccess(Request $request, ProfilOrmada $profilOrmada): void
    {
        $user = $request->user();

        abort_unless(
            $user->isAdmin() || $user->isPemda() || $profilOrmada->admin_id === $user->id,
            403
        );
    }

    private function authorizeProfilMutation(Request $request, ProfilOrmada $profilOrmada): void
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $profilOrmada->admin_id === $user->id, 403);
    }
}
