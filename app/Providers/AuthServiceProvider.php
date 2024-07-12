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
        $roles = [
            'administrador',
            'default',
            'soporte-tecnico-administrador',
            'soporte-tecnico-instalador',
            'cobranzas',
        ];

        foreach ($roles as $role) {
            Gate::define($role, function ($user) use ($role) {
                if (strtolower($user->rol) == $role) {
                    return true;
                }
                return false;
            });
        }

        // Gate::define('administrador', function ($user) {
        //     if (strtolower($user->rol) == 'administrador') {
        //         return true;
        //     }
        //     return false;
        // });

        // Gate::define('default', function ($user) {
        //     if (strtolower($user->rol) == 'default') {
        //         return true;
        //     }
        //     return false;
        // });

        // Gate::define('soporte-tecnico-administrador', function ($user) {
        //     if (strtolower($user->rol) == 'soporte-tecnico-administrador') {
        //         return true;
        //     }
        //     return false;
        // });

        // Gate::define('soporte-tecnico-instalador', function ($user) {
        //     if (strtolower($user->rol) == 'soporte-tecnico-instalador') {
        //         return true;
        //     }
        //     return false;
        // });

        // Gate::define('cobranzas', function ($user) {
        //     if (strtolower($user->rol) == 'cobranzas') {
        //         return true;
        //     }
        //     return false;
        // });


    }
}
