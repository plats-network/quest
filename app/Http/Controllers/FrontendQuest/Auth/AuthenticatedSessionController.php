<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use App\Events\Auth\UserLoginSuccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        //Sample Login
        $sampleUser = [
            'email' => 'super@admin.com',
            'password' => 'secret',
        ];

        $data = [
            'sampleUser' => $sampleUser,
        ];

        return view('quest.auth.login', $data);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember_me;

        if (Auth::guard('quest')->attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember)) {
            $request->session()->regenerate();

            event(new UserLoginSuccess($request, auth()->guard('quest')->user()));

            return redirect()->intended(route('quest.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('quest')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('quest.index'));
    }
}
