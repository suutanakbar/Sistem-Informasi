<?php

namespace App\Providers;

use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\Postingan;
use App\Models\Proposal;
use App\Policies\AgendaPolicy;
use App\Policies\AspirasiPolicy;
use App\Policies\PostinganPolicy;
use App\Policies\ProposalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Proposal::class => ProposalPolicy::class,
        Aspirasi::class => AspirasiPolicy::class,
        Postingan::class => PostinganPolicy::class,
        Agenda::class => AgendaPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
