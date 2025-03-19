
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //Vou ver se o usuario logado tem a permissão de administrador
        foreach(Can::cases() as $can) {
            Gate::define(
                str($can->value)->snake('-')->toString(),
                fn(User $user) => $user->hasPermissionTo($can)
            );
        }
   
    }
}