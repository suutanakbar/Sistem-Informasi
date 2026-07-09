<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = Agenda::query()->with('admin');

        // Filter berdasarkan role
        if ($user->isPengurusOrmada()) {
            // Pengurus hanya melihat agenda miliknya
            $query->where('admin_id', $user->id);
        } elseif ($user->isPemda()) {
            // Pemda melihat semua agenda
            // Bisa filter by kategori
            $kategori = $request->query('kategori');
            if ($kategori) {
                $query->where('kategori', $kategori);
            }
        }
        // Admin melihat semua

        $agendas = $query->latest('dibuat_pada')->paginate(12);

        $kategoriOptions = ['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya'];

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.agenda.index';
        } elseif ($user->isPemda()) {
            $view = 'pemda.agenda.index';
        } else {
            $view = 'admin.agenda.index';
        }
        
        return view($view, compact('agendas', 'kategoriOptions'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();
        $this->authorize('create', Agenda::class);

        if ($user->isPemda()) {
            $view = 'pemda.agenda.create';
        } else {
            $view = 'admin.agenda.create';
        }
        
        return view($view);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('create', Agenda::class);

        $validated = $this->validateAgenda($request);
        
        // Set admin_id = user yang login
        $validated['admin_id'] = $user->id;

        // Handle file upload
        if ($request->hasFile('gambar_poster')) {
            $validated['gambar_poster'] = $request->file('gambar_poster')->store('agenda/poster', 'public');
        }

        // Jika publish, set tanggal_publish
        if ($request->has('is_published') && $request->is_published) {
            $validated['is_published'] = true;
            $validated['tanggal_publish'] = now();
        } else {
            $validated['is_published'] = false;
            $validated['tanggal_publish'] = null;
        }

        // Jika tidak ada kuota volunteer, set deadline null
        if (empty($validated['kuota_volunteer'])) {
            $validated['kuota_volunteer'] = null;
            $validated['deadline_pendaftaran'] = null;
        }

        $agenda = Agenda::create($validated);

        return redirect()
            ->route('agenda.index')
            ->with('status', 'Agenda berhasil dibuat.');
    }

    public function show(Request $request, Agenda $agenda): View
    {
        $user = $request->user();
        
        // Authorization
        $this->authorizeAgendaAccess($user, $agenda);

        $agenda->load('admin');

        // Hitung jumlah volunteer yang sudah diterima
        $volunteerDiterima = $agenda->volunteers()->where('status', 'diterima')->count();

        // Filter volunteers jika ada parameter search
        $volunteersQuery = $agenda->volunteers()->latest('dibuat_pada');
        
        if ($request->has('search_volunteer')) {
            $search = $request->search_volunteer;
            $volunteersQuery->where(function($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status_volunteer') && $request->status_volunteer) {
            $volunteersQuery->where('status', $request->status_volunteer);
        }

        $volunteers = $volunteersQuery->paginate(20, ['*'], 'volunteer_page');

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.agenda.show';
        } elseif ($user->isPemda()) {
            $view = 'pemda.agenda.show';
        } else {
            $view = 'admin.agenda.show';
        }
        
        return view($view, compact('agenda', 'volunteerDiterima', 'volunteers'));
    }

    public function edit(Request $request, Agenda $agenda): View
    {
        $user = $request->user();
        $this->authorize('update', $agenda);

        if ($user->isPemda()) {
            $view = 'pemda.agenda.edit';
        } else {
            $view = 'admin.agenda.edit';
        }
        
        return view($view, compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('update', $agenda);

        $validated = $this->validateAgenda($request, $agenda);

        // Handle file upload
        if ($request->hasFile('gambar_poster')) {
            if ($agenda->gambar_poster) {
                Storage::disk('public')->delete($agenda->gambar_poster);
            }
            $validated['gambar_poster'] = $request->file('gambar_poster')->store('agenda/poster', 'public');
        }

        // Jika publish, set tanggal_publish
        if ($request->has('is_published') && $request->is_published) {
            $validated['is_published'] = true;
            $validated['tanggal_publish'] = now();
        } else {
            $validated['is_published'] = false;
            $validated['tanggal_publish'] = null;
        }

        // Jika tidak ada kuota volunteer, set deadline null
        if (empty($validated['kuota_volunteer'])) {
            $validated['kuota_volunteer'] = null;
            $validated['deadline_pendaftaran'] = null;
        }

        $agenda->update($validated);

        return redirect()
            ->route('agenda.show', $agenda)
            ->with('status', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Request $request, Agenda $agenda): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('delete', $agenda);

        // Delete poster if exists
        if ($agenda->gambar_poster) {
            Storage::disk('public')->delete($agenda->gambar_poster);
        }

        $agenda->delete();

        return redirect()
            ->route('agenda.index')
            ->with('status', 'Agenda berhasil dihapus.');
    }

    public function publish(Request $request, Agenda $agenda): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa publish
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $agenda->update([
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        return back()->with('status', 'Agenda berhasil dipublish.');
    }

    public function daftarVolunteer(Request $request, Agenda $agenda): RedirectResponse
    {
        // Cek apakah agenda masih membuka volunteer
        if (!$agenda->kuota_volunteer || !$agenda->deadline_pendaftaran || !$agenda->is_published) {
            return back()->with('error', 'Agenda ini tidak membuka pendaftaran volunteer.');
        }

        // Cek deadline
        if (now()->greaterThan($agenda->deadline_pendaftaran)) {
            return back()->with('error', 'Pendaftaran volunteer sudah ditutup.');
        }

        // Cek kuota
        $volunteerDiterima = $agenda->volunteers()->where('status', 'diterima')->count();
        if ($volunteerDiterima >= $agenda->kuota_volunteer) {
            return back()->with('error', 'Kuota volunteer sudah penuh.');
        }

        // Validasi input
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alasan' => ['nullable', 'string'],
        ]);

        // Cek apakah email sudah mendaftar di agenda ini
        $existing = Volunteer::where('agenda_id', $agenda->id)
            ->where('email', $validated['email'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah mendaftar sebagai volunteer untuk agenda ini.');
        }

        // Buat pendaftaran volunteer
        Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'alasan' => $validated['alasan'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran volunteer berhasil. Silakan tunggu konfirmasi dari Pemda.');
    }

    public function listVolunteer(Request $request, Agenda $agenda): View
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa manage volunteer
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $volunteers = $agenda->volunteers()->latest('dibuat_pada')->paginate(20);

        return view('agenda.volunteer', compact('agenda', 'volunteers'));
    }

    public function updateStatusVolunteer(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa approve
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
        ]);

        $volunteer->update($validated);

        return back()->with('status', 'Status volunteer berhasil diperbarui.');
    }

    private function validateAgenda(Request $request, ?Agenda $agenda = null): array
    {
        $rules = [
            'nama_agenda' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:kegiatan_ormada,kegiatan_pemda,baksos,pendidikan,kesehatan,lingkungan,lainnya'],
            'deskripsi_agenda' => ['required', 'string'],
            'gambar_poster' => [$agenda ? 'nullable' : 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'waktu_mulai' => ['required', 'date'],
            'waktu_selesai' => ['required', 'date', 'after:waktu_mulai'],
            'tempat' => ['required', 'string', 'max:255'],
            'kuota_volunteer' => ['nullable', 'integer', 'min:1'],
            'deadline_pendaftaran' => ['nullable', 'date', 'before:waktu_mulai'],
        ];

        return $request->validate($rules);
    }

    private function authorizeAgendaAccess($user, Agenda $agenda): void
    {
        // Admin dan Pemda bisa akses semua
        if ($user->isAdmin() || $user->isPemda()) {
            return;
        }

        // Pengurus bisa akses agenda miliknya
        if ($user->isPengurusOrmada() && $agenda->admin_id === $user->id) {
            return;
        }

        // Public hanya bisa lihat yang published
        if (!$user && $agenda->is_published) {
            return;
        }

        abort(403);
    }
}