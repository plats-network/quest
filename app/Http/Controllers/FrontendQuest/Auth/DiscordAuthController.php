<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use Illuminate\Http\Request;

class DiscordAuthController
{

    //handleDiscordCallback
    public function handleDiscordCallback(Request $request)
    {
        $data = $request->all();
        dd($data);
        //Get user info
        $user = Socialite::driver('discord')->user();
        //dd($user);
        //Check has exits user
        //If not register => register => login

        //Get discord user
        $discordId = $user->getId();
        $discordUsername = $user->getNickname();
        //dd($discordId, $discordUsername);

        $discordEmail = $user->getEmail();
        $discordAvatar = $user->getAvatar();
        $discordVerified = $user->user['verified'];
        $discordLocale = $user->user['locale'];
        $discordMfaEnabled = $user->user['mfa_enabled'];
        $discordRefreshToken = $user->refreshToken;

        /** @var User $questUser */
        $userLogin = auth()->guard('quest')->user();
    }
}
