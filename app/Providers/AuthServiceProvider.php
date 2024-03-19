<?php

namespace App\Providers;

use App\Models\FineSetting;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        Gate::define('access-admin', fn (User $user) => $user->isAdministrator());

        Gate::define('activate-fine-setting', fn () => FineSetting::firstOrFail()->is_active);
    }
}
