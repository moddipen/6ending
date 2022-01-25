<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::after(function ($user, $ability) {
            return $user->hasRole('super admin') || $user->hasRole('user') ? true : null;
        });

        Gate::define('isSuperAdmins', 'App\Policies\UserRole@superAdmin');
        Gate::define('isAdmins', 'App\Policies\UserRole@admin');
        Gate::define('isSubAdmins', 'App\Policies\UserRole@subAdmin');
        Gate::define('isSuperMasters', 'App\Policies\UserRole@superMaster');
        Gate::define('isMasters', 'App\Policies\UserRole@master');

        
        
    }
}
