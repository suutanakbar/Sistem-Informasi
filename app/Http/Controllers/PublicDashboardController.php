<?php

namespace App\Http\Controllers;

use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use Illuminate\View\View;

class PublicDashboardController extends Controller
{
    public function index(): View
    {
        return view('public.dashboard', [
            'totalOrmada' => ProfilOrmada::count(),
            'totalAnggota' => AnggotaOrmada::count(),
            'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
            'totalAlumni' => AnggotaOrmada::where('status_aktif', 'alumni')->count(),
            'profilOrmadas' => ProfilOrmada::query()
                ->withCount('anggota')
                ->latest('dibuat_pada')
                ->limit(8)
                ->get(),
        ]);
    }
}
