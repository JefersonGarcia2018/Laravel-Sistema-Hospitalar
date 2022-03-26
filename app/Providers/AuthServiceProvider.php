<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        $this->registerPolicies();

        Gate::define('admin', function($user){

            return $user->admin === 1 ? true : false;
        });
    
        Gate::define('rh', function($user){

            return $user->rh === 1 ? true : false;
        });

        Gate::define('recepcao', function($user){

            return $user->recepcao === 1 ? true : false;
        });

        Gate::define('enfermagem', function($user){

            return $user->enfermagem === 1 ? true : false;
        });

        Gate::define('medicina', function($user){

            return $user->medicina === 1 ? true : false;
        });
    }
}
