<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Enum\Can;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Check if the logged-in user has the administrator permission
        foreach (Can::cases() as $can) {
            Gate::define(
                $can->value,
                fn(User $user) => $user->hasPermissionTo($can)
            );
        }
    }
}
