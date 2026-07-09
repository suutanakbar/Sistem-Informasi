<?php

namespace App\Http\Controllers;

use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaOrmadaController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = AnggotaOrmada::query()
            ->with(['profilOrmada.admin'])
            ->search($request->string('search')->toString())
            ->when($request->filled('status_aktif'), fn (Builder $query) => $query->where('status_aktif', $request->status_aktif))
            ->when($request->filled('is_pengurus'), fn (Builder $query) => $query->where('is_pengurus', $request->is_pengurus));

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();
            abort_if(! $profil, 403, 'Lengkapi profil ormada terlebih dahulu.');
            $query->where('profil_ormada_id', $profil->id);
            $profilOrmadas = collect([$profil]);
        } else {
            $query->when($request->filled('profil_ormada_id'), fn (Builder $query) => $query->where('profil_ormada_id', $request->profil_ormada_id));
            $profilOrmadas = ProfilOrmada::orderBy('nama_universitas')->get();
        }

        $anggotaOrmadas = $query
            ->latest('dibuat_pada')
            ->paginate(15)
            ->withQueryString();

        return view('anggota_ormada.index', compact('anggotaOrmadas', 'profilOrmadas'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();
            abort_if(! $profil, 403, 'Lengkapi profil ormada terlebih dahulu.');
            $profilOrmadas = collect([$profil]);
        } else {
            $profilOrmadas = ProfilOrmada::orderBy('nama_universitas')->get();
        }

        return view('anggota_ormada.create', compact('profilOrmadas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        $validated = $this->validateAnggota($request);

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->first();
            abort_if(! $profil, 403, 'Lengkapi profil ormada terlebih dahulu.');
            $validated['profil_ormada_id'] = $profil->id;
        }

        $anggotaOrmada = AnggotaOrmada::create($validated);

        return redirect()
            ->route('anggota-ormada.show', $anggotaOrmada)
            ->with('status', 'Anggota ormada berhasil ditambahkan.');
    }

    public function show(Request $request, AnggotaOrmada $anggotaOrmada): View
    {
        // Must be authenticated (admin, pengurus, or pemda)
        abort_unless($request->user(), 403);

        $this->authorizeAnggotaAccess($request, $anggotaOrmada);

        $anggotaOrmada->load('profilOrmada.admin');

        $user = $request->user();
        
        if ($user->isPemda()) {
            return view('pemda.anggota_ormada.show', compact('anggotaOrmada'));
        } elseif ($user->isPengurusOrmada()) {
            return view('pengurus.anggota_ormada.show', compact('anggotaOrmada'));
        }

        return view('anggota_ormada.show', compact('anggotaOrmada'));
    }

    public function edit(Request $request, AnggotaOrmada $anggotaOrmada): View
    {
        // Only admin and pengurus can edit, not pemda
        $user = $request->user();
        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        // Ensure they own this profil or is admin
        abort_unless($user->isAdmin() || $anggotaOrmada->profilOrmada?->admin_id === $user->id, 403);

        $profilOrmadas = $user->isAdmin()
            ? ProfilOrmada::orderBy('nama_universitas')->get()
            : collect([$user->profilOrmada()->first()]);

        return view('anggota_ormada.edit', compact('anggotaOrmada', 'profilOrmadas'));
    }

    public function update(Request $request, AnggotaOrmada $anggotaOrmada): RedirectResponse
    {
        $user = $request->user();
        
        // Only admin and pengurus can update, not pemda
        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        // Ensure they own this profil or is admin
        abort_unless($user->isAdmin() || $anggotaOrmada->profilOrmada?->admin_id === $user->id, 403);

        $validated = $this->validateAnggota($request);

        if ($user->isPengurusOrmada()) {
            $validated['profil_ormada_id'] = $user->profilOrmada()->firstOrFail()->id;
        }

        $anggotaOrmada->update($validated);

        return redirect()
            ->route('anggota-ormada.show', $anggotaOrmada)
            ->with('status', 'Anggota ormada berhasil diperbarui.');
    }

    public function destroy(Request $request, AnggotaOrmada $anggotaOrmada): RedirectResponse
    {
        $user = $request->user();
        
        // Only admin and pengurus can delete, not pemda
        abort_unless($user->isAdmin() || $user->isPengurusOrmada(), 403);

        // Ensure they own this profil or is admin
        abort_unless($user->isAdmin() || $anggotaOrmada->profilOrmada?->admin_id === $user->id, 403);

        $anggotaOrmada->delete();

        return redirect()
            ->route('profil-ormada.show', $anggotaOrmada->profilOrmada)
            ->with('status', 'Anggota ormada berhasil dihapus.');
    }

    private function validateAnggota(Request $request): array
    {
        return $request->validate([
            'profil_ormada_id' => ['required', 'exists:profil_ormada,id'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50'],
            'program_studi' => ['required', 'string', 'max:255'],
            'status_aktif' => ['required', 'in:fungsionaris,mahasiswa_biasa,demisioner,alumni'],
            'jabatan' => ['nullable', 'required_if:is_pengurus,YA', 'string', 'max:255'],
            'is_pengurus' => ['required', 'in:YA,TIDAK'],
            'tanggal_masuk_kuliah' => ['nullable', 'date'],
            'tanggal_lulus_kuliah' => ['nullable', 'date'],
            'tanggal_mulai_jabatan' => ['nullable', 'date'],
            'tanggal_akhir_jabatan' => ['nullable', 'date'],
            'tanggal_demisioner' => ['nullable', 'required_if:status_aktif,demisioner', 'date'],
            'tanggal_lulus' => ['nullable', 'required_if:status_aktif,alumni', 'date'],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);
    }

    private function authorizeAnggotaAccess(Request $request, AnggotaOrmada $anggotaOrmada): void
    {
        $user = $request->user();

        abort_unless(
            $user->isAdmin() || $user->isPemda() || $anggotaOrmada->profilOrmada?->admin_id === $user->id,
            403
        );
    }

    private function authorizeAnggotaMutation(Request $request, AnggotaOrmada $anggotaOrmada): void
    {
        $user = $request->user();

        abort_unless($user->isAdmin() || $anggotaOrmada->profilOrmada?->admin_id === $user->id, 403);
    }
}