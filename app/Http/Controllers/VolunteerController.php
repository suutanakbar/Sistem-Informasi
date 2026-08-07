<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\DBException;

class VolunteerController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $query = Volunteer::with(['agenda.admin']);

        // Filter berdasarkan role
        if ($user->isPemda()) {
            // Pemda melihat semua volunteer
        } elseif ($user->isPengurusOrmada()) {
            // Pengurus hanya melihat volunteer untuk agenda miliknya
            $query->whereHas('agenda', function ($q) use ($user) {
                $q->where('admin_id', $user->id);
            });
        }

        $volunteers = $query->latest('dibuat_pada')->paginate(10);

        $view = $user->isPemda() ? 'volunteer.index-pemda' : 'volunteer.index-admin';

        return view($view, compact('volunteers'));
    }

    public function updateStatus(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa update status
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
            'catatan_penolakan' => ['nullable', 'string', 'max:1000'],
        ]);

        // State transition guard
        if (!$volunteer->canTransitionTo($validated['status'])) {
            $currentStatus = $volunteer->status;
            
            return back()
                ->with('error', "Transisi status dari '{$currentStatus}' ke '{$validated['status']}' tidak diizinkan.");
        }

        // Gunakan transaction dengan locking untuk mencegah race condition
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($volunteer, $validated) {
                // Lock row volunteer untuk mencegah race condition
                $lockedVolunteer = Volunteer::where('id', $volunteer->id)->lockForUpdate()->first();

                // Jika akan diterima, cek kuota terlebih dahulu
                if ($validated['status'] === 'diterima') {
                    $agenda = Agenda::where('id', $lockedVolunteer->agenda_id)->lockForUpdate()->first();
                    
                    // Hitung jumlah volunteer yang sudah diterima
                    $volunteerDiterima = Volunteer::where('agenda_id', $agenda->id)
                        ->where('status', 'diterima')
                        ->count();

                    if ($agenda->kuota_volunteer !== null && $volunteerDiterima >= $agenda->kuota_volunteer) {
                        throw new \RuntimeException('Kuota volunteer sudah penuh.');
                    }
                }

                $lockedVolunteer->update([
                    'status' => $validated['status'],
                    'catatan_penolakan' => $validated['status'] === 'ditolak' ? ($validated['catatan_penolakan'] ?? null) : null,
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()
                ->with('error', $e->getMessage());
        }

        return back()
            ->with('status', 'Status volunteer berhasil diperbarui.');
    }

    public function edit(Request $request, Volunteer $volunteer): View
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa edit
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        return view('volunteer.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa update
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alasan' => ['nullable', 'string'],
        ]);

        $volunteer->update($validated);

        return redirect()->route('volunteer.index')
            ->with('status', 'Data volunteer berhasil diperbarui.');
    }
}