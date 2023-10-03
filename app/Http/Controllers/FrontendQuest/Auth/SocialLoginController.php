<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use App\Events\Frontend\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProvider;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $redirectTo = request()->redirectTo;

        if ($redirectTo) {
            return $redirectTo;
        } else {
            return route('quest.index');
        }
    }

    /**
     * Redirect the user to the Provider (Facebook, Google, GitHub...) authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider (Facebook, Google, GitHub...).
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            //Laravel\Socialite\One\User {#2447 ▼ // app\Http\Controllers\FrontendQuest\Auth\SocialLoginController.php:52
            //  +id: "1588364698239397888"
            //  +nickname: "PhanDun97822241"
            //  +name: "Phan Dung"
            //  +email: "dungpxvaix@gmail.com"
            //  +avatar: "http://pbs.twimg.com/profile_images/1588364742015393792/Qvm1C8ru_normal.jpg"
            //  +user: array:42 [▶]
            //  +attributes: array:6 [▶]
            //  +token: "1588364698239397888-OxFF5Dam8fsLNyccNL7cdBIUrVjixA"
            //  +tokenSecret: "CfGVWZiURWnS9PuSFVFEodHKUIpmedQSM0l1TRJbRN4p9"
            //}

            $authUser = $this->findOrCreateUser($user, $provider);

            Auth::guard('quest')->login($authUser, true);
        } catch (Exception $e) {
            return redirect(route('quest.index'));
        }

        return redirect(route('quest.index'));
    }

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($socialUser, $provider)
    {
        if ($authUser = UserProvider::where('provider_id', $socialUser->getId())->first()) {
            $authUser = User::findOrFail($authUser->user->id);

            return $authUser;
        } elseif ($authUser = User::where('email', $socialUser->getEmail())->first()) {
            UserProvider::create([
                'user_id' => $authUser->id,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'provider' => $provider,
            ]);

            return $authUser;
        } else {
            $name = $socialUser->getName();

            $name_parts = $this->split_name($name);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1];
            $email = $socialUser->getEmail();

            if ($email == '') {
                Log::error('Social Login does not have email!');

                flash('Email address is required!')->error()->important();

                return redirect(route('quest.index'));
            }

            try {
                $password = bcrypt($socialUser->getId());
                $user = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);
            }catch (\Exception $e){
                Log::error($e->getMessage());
                flash('Email address is required!')->error()->important();
                return redirect(route('quest.index'));
            }

            $media = $user->addMediaFromUrl($socialUser->getAvatar())->toMediaCollection('users');
            $user->avatar = $media->getUrl();
            $user->save();
            //Create User Profile
            $user->profile()->create([
                'user_id' => $user->id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'name' => $name,
                'avatar' => $user->avatar,
            ]);
            //assignRole
            $user->assignRole('user');

            event(new UserRegistered($user));

            UserProvider::create([
                'user_id' => $user->id,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'provider' => $provider,
            ]);

            return $user;
        }
    }

    /**
     * Split Name into first name and last name.
     */
    public function split_name($name)
    {
        $name = trim($name);

        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#'.$last_name.'#', '', $name));

        return [$first_name, $last_name];
    }
}
