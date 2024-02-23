<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $keyCookie = Cookie::get('ref');
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $cookie = Cookie::get('referral');

        $referred_by = $cookie ? Hashids::decode($cookie)[0] : null;


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referred_by' => $referred_by
        ]);

        $keyCookie = Cookie::get('ref');

        //event(new \App\Events\UserReferred($keyCookie, $user));
        $referral = \App\Models\ReferralLink::find($keyCookie);
        if (!is_null($referral)) {

            $modelAdd = \App\Models\ReferralRelationship::create([
                'referral_link_id' => $referral->id,
                'user_id' => $user->id
            ]);

            // Example...
            if ($referral->program->name === 'Sign-up Bonus') {
                // User who was sharing link
                $provider = $referral->user;
                //$provider->addCredits(15);
                $provider->addPoints(15);
                // User who used the link
                $userUsedLink = $user;
                //$user->addCredits(20);
                $userUsedLink->addPoints(20);
                //Level Up Add Points

            }

        }


        event(new Registered($user));

        Auth::guard('quest')::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
