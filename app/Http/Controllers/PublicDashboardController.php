<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AnggotaOrmada;
use App\Models\Aspirasi;
use App\Models\Postingan;
use App\Models\ProfilOrmada;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $agendaIndex = $request->get('agenda_index', 0);
        
        $agendas = Agenda::query()
            ->with('admin')
            ->published()
            ->upcoming()
            ->limit(6)
            ->get();

        // Ensure agenda_index is within valid range
        if ($agendaIndex >= $agendas->count()) {
            $agendaIndex = 0;
        }

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
            'agendas' => $agendas,
            'agendaIndex' => $agendaIndex,
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

    public function postingan(Request $request): View
    {
        $jenis = $request->get('jenis');
        
        $postingans = Postingan::query()
            ->with('admin')
            ->published()
            ->when($jenis, fn($query) => $query->byJenis($jenis))
            ->latest('tanggal_publish')
            ->limit(12)
            ->get();

        return view('public.postingan', compact('postingans', 'jenis'));
    }

    public function filterPostingan(Request $request)
    {
        $jenis = $request->get('jenis');
        
        $postingans = Postingan::query()
            ->with('admin')
            ->published()
            ->when($jenis, fn($query) => $query->byJenis($jenis))
            ->latest('tanggal_publish')
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $postingans
        ]);
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

    public function showPostingan(Postingan $postingan): View
    {
        // Only show published postingan to public
        abort_if(!$postingan->is_published, 404);

        $postingan->load('admin');

        return view('public.postingan-show', compact('postingan'));
    }
}
