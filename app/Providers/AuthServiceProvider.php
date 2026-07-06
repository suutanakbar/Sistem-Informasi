<?php

namespace App\Providers;

use App\Models\Aspirasi;
use App\Models\Proposal;
use App\Policies\AspirasiPolicy;
use App\Policies\ProposalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Proposal::class => ProposalPolicy::class,
        Aspirasi::class => AspirasiPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}