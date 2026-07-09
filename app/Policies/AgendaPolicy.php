<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Agenda;

class AgendaPolicy
{
    public function create(Admin $user): bool
    {
        // Hanya Admin dan Pemda yang bisa membuat agenda
        return $user->isAdmin() || $user->isPemda();
    }

    public function update(Admin $user, Agenda $agenda): bool
    {
        // Hanya Admin dan Pemda yang bisa edit agenda
        return $user->isAdmin() || $user->isPemda();
    }

    public function delete(Admin $user, Agenda $agenda): bool
    {
        // Hanya Admin dan Pemda yang bisa hapus agenda
        return $user->isAdmin() || $user->isPemda();
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