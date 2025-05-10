<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        // Customize authentication to use Admin model
        $this->app['auth']->viaRequest('web', function ($request) {
            if ($request->input('email')) {
                $admin = Admin::where('email', $request->input('email'))->where('status', 1)->first();
                if ($admin && $request->input('password')) {
                    if (\Hash::check($request->input('password'), $admin->password)) {
                        return $admin;
                    }
                }
            }
        });
    }
}