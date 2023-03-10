<?php

namespace App\Providers;


use Illuminate\Support\Facades\Auth;
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

        Gate::define('is_admin',function(){
            $role = Auth::check() ? Auth::user()->role->name : [];
            if ($role == 'admin') {
                return "admin";
            }
        });

        Gate::define('is_manager', function () {
            $role = Auth::check() ? Auth::user()->role->name : [];
            if ($role == 'manager') {
                return "manager";
            }
        });

        //
    }
}
