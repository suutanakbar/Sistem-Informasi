<?php

namespace App\Http\Controllers;

use App\Models\AnggotaOrmada;
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
                'totalAlumni' => AnggotaOrmada::where('status_aktif', 'alumni')->count(),
                'totalDemisioner' => AnggotaOrmada::where('status_aktif', 'demisioner')->count(),
            ]);
        }

        if ($user->isPemda()) {
            return view('dashboard.pemda', [
                'totalOrmada' => ProfilOrmada::count(),
                'totalAnggota' => AnggotaOrmada::where('status_aktif', 'aktif')->count(),
                'agendaMendatang' => \App\Models\Agenda::where('tanggal_mulai', '>=', now())->count(),
                'proposalMenunggu' => \App\Models\Proposal::where('status', 'menunggu')->count(),
            ]);
        }

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->withCount([
                'anggota',
                'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
                'anggota as alumni_count' => fn ($query) => $query->where('status_aktif', 'alumni'),
            ])->first();

            return view('dashboard.pengurus', [
                'profil' => $profil,
                'totalAnggota' => $profil?->anggota_count ?? 0,
                'totalPengurus' => $profil?->pengurus_count ?? 0,
                'totalAlumni' => $profil?->alumni_count ?? 0,
                'totalProposal' => \App\Models\Proposal::where('admin_id', $user->id)->count(),
            ]);
        }

        // Fallback to default dashboard
        return view('dashboard', [
            'profil' => null,
            'totalOrmada' => ProfilOrmada::count(),
            'totalAnggota' => AnggotaOrmada::count(),
            'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
            'totalAlumni' => AnggotaOrmada::where('status_aktif', 'alumni')->count(),
            'totalDemisioner' => AnggotaOrmada::where('status_aktif', 'demisioner')->count(),
        ]);
    }
}
