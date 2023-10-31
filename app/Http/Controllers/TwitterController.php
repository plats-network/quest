<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleTwitterCallback()
    {
        try {

            $user = Socialite::driver('twitter')->user();

            $finduser = User::where('twitter_id', $user->id)->first();

            if($finduser){

                //Auth::login($finduser);

                return redirect()->route('quest.index');

            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'name' => $user->name,
                    'twitter_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                //Auth::login($newUser);

                return redirect()->route('quest.index');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
