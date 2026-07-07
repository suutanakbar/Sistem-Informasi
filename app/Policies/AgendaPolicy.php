<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Agenda;

class AgendaPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin();
    }

    public function update(Admin $user, Agenda $agenda): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa edit agenda miliknya
        return $agenda->admin_id === $user->id;
    }

    public function delete(Admin $user, Agenda $agenda): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa hapus agenda miliknya
        return $agenda->admin_id === $user->id;
    }

    public function publish(Admin $user, Agenda $agenda): bool
    {
        // Hanya Pemda atau Admin yang bisa publish
        return $user->isPemda() || $user->isAdmin();
    }

    public function manageVolunteer(Admin $user, Agenda $agenda): bool
    {
        // Hanya Pemda atau Admin yang bisa manage volunteer
        return $user->isPemda() || $user->isAdmin();
    }
}