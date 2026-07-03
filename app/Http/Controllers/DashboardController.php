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

        if ($user->isPengurusOrmada()) {
            $profil = $user->profilOrmada()->withCount([
                'anggota',
                'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
                'anggota as alumni_count' => fn ($query) => $query->where('status_aktif', 'alumni'),
                'anggota as demisioner_count' => fn ($query) => $query->where('status_aktif', 'demisioner'),
            ])->first();

            return view('dashboard', [
                'profil' => $profil,
                'totalOrmada' => $profil ? 1 : 0,
                'totalAnggota' => $profil?->anggota_count ?? 0,
                'totalPengurus' => $profil?->pengurus_count ?? 0,
                'totalAlumni' => $profil?->alumni_count ?? 0,
                'totalDemisioner' => $profil?->demisioner_count ?? 0,
            ]);
        }

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
