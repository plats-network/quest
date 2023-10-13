<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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
        //$this->registerPolicies();
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });
        //
        /*VerifyEmail::createUrlUsing(function ($notifiable) {
            // $url is directly set as the API endpoint for email verification
            // see 'verification.verify' route
            $url = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(Config::get('auth.verification.expire', 60)), [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            return env('FRONT_END_URL', 'http://localhost').'/email-verification?url='.urlencode($url);
        });

        ResetPassword::createUrlUsing(
            fn ($user, string $token) => env('FRONT_END_URL', 'http://localhost').'/reset-password?email='.$user->email.'&token='.$token
        );*/
    }
}
