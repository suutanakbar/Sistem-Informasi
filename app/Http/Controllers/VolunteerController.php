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

        $volunteers = $query->latest('dibuat_pada')->get();

        $layout = $user->isPemda() ? 'layouts.pemda' : 'layouts.admin';

        return view('volunteer.index', compact('volunteers', 'layout'));
    }

    public function updateStatus(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $user = $request->user();
        
        // Hanya Pemda atau Admin yang bisa update status
        abort_unless($user->isPemda() || $user->isAdmin(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
        ]);

        // State transition guard
        if (!$volunteer->canTransitionTo($validated['status'])) {
            $currentStatus = $volunteer->status;
            
            if (in_array($currentStatus, [Volunteer::STATUS_DITERIMA, Volunteer::STATUS_DITOLAK])) {
                return redirect()->route('volunteer.index')
                    ->with('error', "Volunteer dengan status '{$currentStatus}' adalah final dan tidak dapat diubah.");
            }
            
            return redirect()->route('volunteer.index')
                ->with('error', "Transisi status dari '{$currentStatus}' ke '{$validated['status']}' tidak diizinkan.");
        }

        // Gunakan transaction dengan locking untuk mencegah race condition saat update status
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($volunteer, $validated) {
                // Lock row volunteer untuk mencegah race condition
                $lockedVolunteer = Volunteer::where('id', $volunteer->id)->lockForUpdate()->first();
                
                // Jika status sudah final, tidak bisa diubah lagi
                if ($lockedVolunteer->status !== 'pending') {
                    throw new \RuntimeException('Status volunteer sudah final dan tidak dapat diubah.');
                }

                // Jika akan diterima, cek kuota terlebih dahulu
                if ($validated['status'] === 'diterima') {
                    $agenda = Agenda::where('id', $lockedVolunteer->agenda_id)->lockForUpdate()->first();
                    
                    // Hitung jumlah volunteer yang sudah diterima
                    $volunteerDiterima = Volunteer::where('agenda_id', $agenda->id)
                        ->where('status', 'diterima')
                        ->count();

                    if ($volunteerDiterima >= $agenda->kuota_volunteer) {
                        throw new \RuntimeException('Kuota volunteer sudah penuh.');
                    }
                }

                $lockedVolunteer->update(['status' => $validated['status']]);
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('volunteer.index')
                ->with('error', $e->getMessage());
        }

        return redirect()->route('volunteer.index')
            ->with('status', 'Status volunteer berhasil diperbarui.');
    }
}