<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Postingan;

class PostinganPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin();
    }

    public function update(Admin $user, Postingan $postingan): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa edit postingan miliknya
        return $postingan->admin_id === $user->id;
    }

    public function delete(Admin $user, Postingan $postingan): bool
    {
        // Admin bisa hapus semua, pengurus bisa hapus miliknya
        return $user->isAdmin() || $postingan->admin_id === $user->id;
    }

    public function publish(Admin $user, Postingan $postingan): bool
    {
        // Hanya Pemda atau Admin yang bisa publish
        return $user->isPemda() || $user->isAdmin();
    }
}