<?php

namespace App\Services\Traits;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait AuthenticatesUsers
{
    /**
     * Attempt to log the user into the application.
     *
     * @param array $credentials
     * @param bool $remember
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|boolean
     */
    protected function attemptLogin(array $credentials = [], $remember = null)
    {
        $request = request();

        if (!$this->guard()->attempt($credentials, $remember)) {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->limiter()->hit($this->throttleKey($request), $this->decayMinutes());

            return false;
        }

        $this->clearLoginAttempts($request);

        // Send the response after the user was authenticated.
        $request->session()->regenerate();

        return $this->guard()->user();
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email|' . $request->ip()));
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return 1;
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
