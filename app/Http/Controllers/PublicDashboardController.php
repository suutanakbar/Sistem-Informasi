<?php

namespace App\Http\Controllers;

use App\Models\AnggotaOrmada;
use App\Models\Aspirasi;
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
            'aspirasis' => Aspirasi::query()
                ->with(['profilOrmada' => fn ($query) => $query->select('id', 'nama_universitas', 'logo')])
                ->latest('dibuat_pada')
                ->limit(6)
                ->get(),
        ]);
    }

    public function aspirasi(): View
    {
        $aspirasis = Aspirasi::query()
            ->with(['profilOrmada' => fn ($query) => $query->select('id', 'nama_universitas', 'logo')])
            ->latest('dibuat_pada')
            ->paginate(12);

        return view('public.aspirasi', compact('aspirasis'));
    }
}
