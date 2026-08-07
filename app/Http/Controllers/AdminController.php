<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admin.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'peran' => ['required', 'in:admin,pemda,pengurus_ormada'],
        ]);

        Admin::create($validated);

        return redirect()->route('admin.index')
            ->with('status', 'Admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin): View
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'peran' => ['required', 'in:admin,pemda,pengurus_ormada'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')
            ->with('status', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        // Prevent self-deletion
        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.index')
            ->with('status', 'Admin berhasil dihapus.');
    }
}