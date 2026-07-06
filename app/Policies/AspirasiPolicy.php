<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Aspirasi;

class AspirasiPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isAdmin();
    }

    public function update(Admin $user, Aspirasi $aspirasi): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Pengurus ormada bisa edit aspirasi milik profilnya
        if ($user->isPengurusOrmada()) {
            $profilId = $user->profilOrmada()->first()?->id;
            return $aspirasi->profil_ormada_id === $profilId;
        }

        return false;
    }

    public function delete(Admin $user, Aspirasi $aspirasi): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Pengurus ormada bisa hapus aspirasi milik profilnya
        if ($user->isPengurusOrmada()) {
            $profilId = $user->profilOrmada()->first()?->id;
            return $aspirasi->profil_ormada_id === $profilId;
        }

        return false;
    }

    public function respond(Admin $user, Aspirasi $aspirasi): bool
    {
        // Hanya Pemda atau Admin yang bisa menanggapi
        return $user->isPemda() || $user->isAdmin();
    }
}