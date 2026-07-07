<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AnggotaOrmada;
use App\Models\Aspirasi;
use App\Models\Postingan;
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
            'postingans' => Postingan::query()
                ->with('admin')
                ->published()
                ->limit(6)
                ->get(),
            'agendas' => Agenda::query()
                ->with('admin')
                ->published()
                ->upcoming()
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

    public function postingan(): View
    {
        $postingans = Postingan::query()
            ->with('admin')
            ->published()
            ->limit(12)
            ->get();

        return view('public.postingan', compact('postingans'));
    }

    public function agenda(): View
    {
        $agendas = Agenda::query()
            ->with('admin')
            ->published()
            ->upcoming()
            ->limit(12)
            ->get();

        return view('public.agenda', compact('agendas'));
    }

    public function showAgenda(Agenda $agenda): View
    {
        // Only show published agendas to public
        abort_if(!$agenda->is_published, 404);

        $agenda->load('admin', 'volunteers');
        
        // Count accepted volunteers
        $volunteerDiterima = $agenda->volunteers()->where('status', 'diterima')->count();

        return view('public.agenda-show', compact('agenda', 'volunteerDiterima'));
    }
}
