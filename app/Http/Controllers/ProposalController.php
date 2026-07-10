<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProposalController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = Proposal::query()
            ->with(['pengaju', 'dinasTujuan']);

        if ($user->isPengurusOrmada()) {
            $query->where('admin_id', $user->id);
        } elseif ($user->isPemda()) {
            $query->where('dinas_tujuan_id', $user->id);
        }

        $status = $request->query('status');
        $jenisBantuan = $request->query('jenis_bantuan');

        $proposals = $query->filter($status, $jenisBantuan)
            ->latest('dibuat_pada')
            ->paginate(12);

        $statusOptions = ['diajukan', 'diproses_pemda', 'dana_cair', 'ditolak'];
        $jenisBantuanOptions = ['dana', 'izin', 'tempat', 'fasilitas'];

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.proposal.index';
        } elseif ($user->isPemda()) {
            $view = 'pemda.proposal.index';
        } else {
            $view = 'admin.proposal.index';
        }
        
        return view($view, compact('proposals', 'statusOptions', 'jenisBantuanOptions'));
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

        $dinasTujuanList = Admin::where('peran', 'pemda')->get(['id', 'nama']);

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.proposal.create';
        } elseif ($user->isPemda()) {
            $view = 'pemda.proposal.create';
        } else {
            $view = 'admin.proposal.create';
        }
        
        return view($view, compact('dinasTujuanList'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

        $validated = $this->validateProposal($request);
        $validated['admin_id'] = $user->id;

        if ($request->hasFile('file_proposal')) {
            $validated['file_proposal'] = $request->file('file_proposal')->store('proposal', 'public');
        }

        $proposal = Proposal::create($validated);

        return redirect()
            ->route('proposal.show', $proposal)
            ->with('status', 'Proposal berhasil diajukan.');
    }

    public function show(Request $request, Proposal $proposal): View
    {
        $user = $request->user();

        $this->authorizeProposalAccess($user, $proposal);

        $proposal->load('pengaju', 'dinasTujuan');

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.proposal.show';
        } elseif ($user->isPemda()) {
            $view = 'pemda.proposal.show';
        } else {
            $view = 'admin.proposal.show';
        }
        
        return view($view, compact('proposal'));
    }

    public function edit(Request $request, Proposal $proposal): View
    {
        $user = $request->user();

        $this->authorizeProposalMutation($user, $proposal);

        $dinasTujuanList = Admin::where('peran', 'pemda')->get(['id', 'nama']);

        if ($user->isPengurusOrmada()) {
            $view = 'pengurus.proposal.edit';
        } elseif ($user->isPemda()) {
            $view = 'pemda.proposal.edit';
        } else {
            $view = 'admin.proposal.edit';
        }
        
        return view($view, compact('proposal', 'dinasTujuanList'));
    }

    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        $user = $request->user();

        $this->authorizeProposalMutation($user, $proposal);

        $validated = $this->validateProposal($request, $proposal);

        if ($request->hasFile('file_proposal')) {
            if ($proposal->file_proposal) {
                Storage::disk('public')->delete($proposal->file_proposal);
            }

            $validated['file_proposal'] = $request->file('file_proposal')->store('proposal', 'public');
        }

        $proposal->update($validated);

        return redirect()
            ->route('proposal.show', $proposal)
            ->with('status', 'Proposal berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Proposal $proposal): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user->isPemda() || $user->isAdmin(), 403);
        abort_if($proposal->dinas_tujuan_id !== $user->id && !$user->isAdmin(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:diajukan,diproses_pemda,dana_cair,ditolak'],
            'catatan_pemda' => ['nullable', 'string'],
        ]);

        $proposal->update($validated);

        return back()->with('status', 'Status proposal berhasil diperbarui.');
    }

    public function destroy(Request $request, Proposal $proposal): RedirectResponse
    {
        $user = $request->user();
        $this->authorize('delete', $proposal);

        if ($proposal->file_proposal) {
            Storage::disk('public')->delete($proposal->file_proposal);
        }

        $proposal->delete();

        return redirect()
            ->route('proposal.index')
            ->with('status', 'Proposal berhasil dihapus.');
    }

    private function validateProposal(Request $request, ?Proposal $proposal = null): array
    {
        $rules = [
            'dinas_tujuan_id' => ['required', 'exists:admin,id'],
            'judul_kegiatan' => ['required', 'string', 'max:255'],
            'deskripsi_kegiatan' => ['required', 'string'],
            'jenis_bantuan' => ['required', 'in:dana,izin,tempat,fasilitas'],
            'anggaran_dibutuhkan' => ['nullable', 'integer', 'min:0'],
            'file_proposal' => [$proposal ? 'nullable' : 'required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];

        return $request->validate($rules);
    }

    private function authorizeProposalAccess(Admin $user, Proposal $proposal): void
    {
        abort_unless(
            $user->isAdmin() ||
            $proposal->admin_id === $user->id ||
            $proposal->dinas_tujuan_id === $user->id,
            403
        );
    }

    private function authorizeProposalMutation(Admin $user, Proposal $proposal): void
    {
        abort_unless($user->isAdmin() || $proposal->admin_id === $user->id, 403);
    }
}