<?php

namespace App\Providers;

use App\Mail\ForgotPasswordEmail;
use App\Mail\VerificationEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
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

        Gate::define('executeAsManager', function () {
            return auth()->user()->isManager();
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return VerificationEmail::build($notifiable, $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return ForgotPasswordEmail::build($notifiable, $token);
        });
    }
}
