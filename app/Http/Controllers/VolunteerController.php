<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VolunteerController extends Controller
{
    public function index(): View
    {
        $volunteers = Volunteer::with(['agenda', 'profilOrmada'])->get();
        return view('volunteer.index', compact('volunteers'));
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