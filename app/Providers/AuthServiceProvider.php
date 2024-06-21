<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('administrador', function ($user) {
            if (strtolower($user->rol) == 'administrador') {
                return true;
            }
            return false;
        });

        Gate::define('default', function ($user) {
            if (strtolower($user->rol) == 'default') {
                return true;
            }
            return false;
        });

        Gate::define('soporte-tecnico', function ($user) {
            if (strtolower($user->rol) == 'soporte-tecnico') {
                return true;
            }
            return false;
        });

        Gate::define('cobranzas', function ($user) {
            if (strtolower($user->rol) == 'cobranzas') {
                return true;
            }
            return false;
        });


    }
}
