<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('accessAdmin', function(User $user){
            return $user->role === 'Admin';
        });
        
        Gate::define('accessUser', function(User $user){
            return $user->role === 'User';
        });
    }
}