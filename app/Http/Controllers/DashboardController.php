<?php

namespace App\Http\Controllers;

use App\Models\AnggotaOrmada;
use App\Models\Postingan;
use App\Models\ProfilOrmada;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return view('dashboard.admin', [
                'totalOrmada' => ProfilOrmada::count(),
                'totalAnggota' => AnggotaOrmada::count(),
                'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
                'totalMahasiswa' => AnggotaOrmada::where('is_pengurus', 'TIDAK')->count(),
                'beritaTerbaru' => Postingan::query()
                    ->with('admin')
                    ->latest('dibuat_pada')
                    ->limit(6)
                    ->get(),
            ]);
        }

        if ($user->isPemda()) {
            return view('dashboard.pemda', [
                'totalOrmada' => ProfilOrmada::count(),
                'totalAnggota' => AnggotaOrmada::whereIn('status_aktif', ['mahasiswa', 'fungsionaris'])->count(),
                'agendaMendatang' => \App\Models\Agenda::where('waktu_mulai', '>=', now())->count(),
                'proposalMenunggu' => \App\Models\Proposal::where('status', 'diajukan')->count(),
            ]);
        }

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->withCount([
                'anggota',
                'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
            ])->first();

            return view('dashboard.pengurus', [
                'profil' => $profil,
                'totalAnggota' => $profil?->anggota_count ?? 0,
                'totalPengurus' => $profil?->pengurus_count ?? 0,
                'totalMahasiswa' => ($profil?->anggota_count ?? 0) - ($profil?->pengurus_count ?? 0),
                'totalProposal' => \App\Models\Proposal::where('admin_id', $user->id)->count(),
            ]);
        }

        // Fallback to default dashboard
        return view('dashboard', [
            'profil' => null,
            'totalOrmada' => ProfilOrmada::count(),
            'totalAnggota' => AnggotaOrmada::count(),
            'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
            'totalMahasiswa' => AnggotaOrmada::where('is_pengurus', 'TIDAK')->count(),
        ]);
    }
}
