<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Agenda;

class AgendaPolicy
{
    public function create(Admin $user): bool
    {
        // Admin, Pemda, dan Pengurus Ormada bisa membuat agenda
        return $user->isAdmin() || $user->isPemda() || $user->isPengurusOrmada();
    }

    public function update(Admin $user, Agenda $agenda): bool
    {
        // Hanya Admin dan Pemda yang bisa edit agenda
        return $user->isAdmin() || $user->isPemda();
    }

    public function delete(Admin $user, Agenda $agenda): bool
    {
        // Admin bisa hapus semua, pengurus bisa hapus miliknya
        return $user->isAdmin() || $agenda->admin_id === $user->id;
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