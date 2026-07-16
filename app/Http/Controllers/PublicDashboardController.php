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

        $profilOrmadas = ProfilOrmada::query()
            ->withCount('anggota')
            ->latest('dibuat_pada')
            ->limit(8)
            ->get();

        // Prepare agenda data for carousel
        $agendasData = $agendas->map(function($agenda) {
            return [
                'id' => $agenda->id,
                'nama_agenda' => $agenda->nama_agenda,
                'kategori' => ucfirst(str_replace('_', ' ', $agenda->kategori)),
                'waktu_mulai' => $agenda->waktu_mulai->format('d M Y') . ' • ' . $agenda->waktu_mulai->format('H:i') . ' WIB',
                'waktu_mulai_time' => $agenda->waktu_mulai->format('H:i'),
                'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi_agenda), 200),
                'tempat' => \Illuminate\Support\Str::limit($agenda->tempat, 15),
                'kuota' => $agenda->kuota_volunteer ?? '∞',
                'gambar_poster' => $agenda->gambar_poster ? asset('storage/' . $agenda->gambar_poster) : null,
                'deadline_pendaftaran' => $agenda->deadline_pendaftaran ? $agenda->deadline_pendaftaran->format('d M Y H:i') . ' WIB' : null,
                'detail_url' => route('public.agenda.show', $agenda)
            ];
        });

        return view('public.dashboard', [
            'totalOrmada' => ProfilOrmada::count(),
            'totalAnggota' => AnggotaOrmada::count(),
            'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
            'totalMahasiswa' => AnggotaOrmada::where('status_aktif', 'mahasiswa')->count(),
            'totalLulus' => AnggotaOrmada::whereNotNull('tanggal_lulus_kuliah')->count(),
            'profilOrmadas' => $profilOrmadas,
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
            'agendasData' => $agendasData,
        ]);
    }

    public function aspirasi(Request $request): View
    {
        $aspirasiIndex = $request->get('aspirasi_index', 0);
        
        $aspirasis = Aspirasi::query()
            ->with(['profilOrmada' => fn ($query) => $query->select('id', 'nama_universitas', 'logo')])
            ->latest('dibuat_pada')
            ->limit(12)
            ->get();

        // Ensure aspirasi_index is within valid range
        if ($aspirasiIndex >= $aspirasis->count()) {
            $aspirasiIndex = 0;
        }

        // Prepare aspirasi data for carousel
        $aspirasisData = $aspirasis->map(function($aspirasi) {
            return [
                'id' => $aspirasi->id,
                'topik_aspirasi' => $aspirasi->topik_aspirasi,
                'nama_universitas' => $aspirasi->profilOrmada->nama_universitas ?? 'Unknown',
                'logo' => $aspirasi->profilOrmada->logo ? asset('storage/' . $aspirasi->profilOrmada->logo) : null,
                'status' => $aspirasi->tanggapan_pemda ? 'Sudah Ditanggapi' : 'Menunggu Tanggapan',
                'status_color' => $aspirasi->tanggapan_pemda ? 'green' : 'yellow',
                'detail_aspirasi' => \Illuminate\Support\Str::limit(strip_tags($aspirasi->detail_aspirasi), 200),
                'tanggapan_pemda' => $aspirasi->tanggapan_pemda ? \Illuminate\Support\Str::limit(strip_tags($aspirasi->tanggapan_pemda), 150) : null,
                'dibuat_pada' => $aspirasi->dibuat_pada->diffForHumans(),
                'detail_url' => route('public.aspirasi.show', $aspirasi)
            ];
        });

        return view('public.aspirasi', [
            'aspirasis' => $aspirasis,
            'aspirasiIndex' => $aspirasiIndex,
            'aspirasisData' => $aspirasisData,
        ]);
    }

    public function postingan(Request $request): View
    {
        $jenis = $request->get('jenis');
        $postinganIndex = $request->get('postingan_index', 0);
        
        $postingans = Postingan::query()
            ->with('admin')
            ->published()
            ->when($jenis, fn($query) => $query->byJenis($jenis))
            ->latest('tanggal_publish')
            ->limit(12)
            ->get();

        // Ensure postingan_index is within valid range
        if ($postinganIndex >= $postingans->count()) {
            $postinganIndex = 0;
        }

        // Prepare postingan data for carousel
        $postingansData = $postingans->map(function($postingan) {
            return [
                'id' => $postingan->id,
                'judul' => $postingan->judul,
                'jenis' => ucfirst($postingan->jenis),
                'tanggal_publish' => $postingan->tanggal_publish->format('d M Y'),
                'isi_konten' => \Illuminate\Support\Str::limit(strip_tags($postingan->isi_konten), 200),
                'foto' => $postingan->foto ? asset('storage/' . $postingan->foto) : null,
                'detail_url' => route('public.postingan.show', $postingan)
            ];
        });

        return view('public.postingan', [
            'postingans' => $postingans,
            'jenis' => $jenis,
            'postinganIndex' => $postinganIndex,
            'postingansData' => $postingansData,
        ]);
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
            ->get()
            ->map(function ($postingan) {
                return [
                    'id' => $postingan->id,
                    'judul' => $postingan->judul,
                    'tanggal_publish' => $postingan->tanggal_publish->format('d M Y'),
                    'isi_konten' => strip_tags($postingan->isi_konten),
                    'foto' => $postingan->foto ? asset('storage/' . $postingan->foto) : null,
                    'detail_url' => route('public.postingan.show', $postingan),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $postingans
        ]);
    }

    public function agenda(Request $request): View
    {
        $agendaIndex = $request->get('agenda_index', 0);
        
        $agendas = Agenda::query()
            ->with('admin')
            ->published()
            ->upcoming()
            ->limit(12)
            ->get();

        // Ensure agenda_index is within valid range
        if ($agendaIndex >= $agendas->count()) {
            $agendaIndex = 0;
        }

        // Prepare agenda data for carousel
        $agendasData = $agendas->map(function($agenda) {
            return [
                'id' => $agenda->id,
                'nama_agenda' => $agenda->nama_agenda,
                'kategori' => ucfirst(str_replace('_', ' ', $agenda->kategori)),
                'waktu_mulai' => $agenda->waktu_mulai->format('d M Y') . ' • ' . $agenda->waktu_mulai->format('H:i') . ' WIB',
                'waktu_mulai_time' => $agenda->waktu_mulai->format('H:i'),
                'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi_agenda), 200),
                'tempat' => \Illuminate\Support\Str::limit($agenda->tempat, 15),
                'kuota' => $agenda->kuota_volunteer ?? '∞',
                'gambar_poster' => $agenda->gambar_poster ? asset('storage/' . $agenda->gambar_poster) : null,
                'deadline_pendaftaran' => $agenda->deadline_pendaftaran ? $agenda->deadline_pendaftaran->format('d M Y H:i') . ' WIB' : null,
                'detail_url' => route('public.agenda.show', $agenda)
            ];
        });

        return view('public.agenda', [
            'agendas' => $agendas,
            'agendaIndex' => $agendaIndex,
            'agendasData' => $agendasData,
        ]);
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

    public function showAspirasi(Aspirasi $aspirasi): View
    {
        $aspirasi->load('profilOrmada');

        return view('public.aspirasi-show', compact('aspirasi'));
    }

    public function showOrmada(ProfilOrmada $profilOrmada): View
    {
        $profilOrmada->load('admin')->loadCount([
            'anggota',
            'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
        ]);

        $anggotaTerbaru = $profilOrmada->anggota()
            ->select('id', 'profil_ormada_id', 'nama_lengkap', 'program_studi', 'status_aktif', 'tanggal_lulus', 'dibuat_pada')
            ->latest('dibuat_pada')
            ->limit(8)
            ->get();

        return view('public.ormada-show', compact('profilOrmada', 'anggotaTerbaru'));
    }

    public function ormada(Request $request): View
    {
        $profilOrmadas = ProfilOrmada::query()
            ->with('admin')
            ->withCount([
                'anggota',
                'anggota as pengurus_count' => fn ($query) => $query->where('is_pengurus', 'YA'),
            ])
            ->latest('dibuat_pada')
            ->paginate(12);

        return view('public.ormada', compact('profilOrmadas'));
    }
}
