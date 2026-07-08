<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        $validated = $request->validate([
            'status' => ['required', 'in:diterima,ditolak'],
        ]);

        $volunteer->update(['status' => $validated['status']]);

        return redirect()->route('volunteer.index')
            ->with('status', 'Status volunteer berhasil diperbarui.');
    }
}