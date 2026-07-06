<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Proposal;

class ProposalPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isAdmin();
    }

    public function update(Admin $user, Proposal $proposal): bool
    {
        return $user->isAdmin() || $proposal->admin_id === $user->id;
    }

    public function delete(Admin $user, Proposal $proposal): bool
    {
        return $user->isAdmin() || $proposal->admin_id === $user->id;
    }
}