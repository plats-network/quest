<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController
{
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    protected function sendResetResponse(Request $request, $response)
    {
        $response = ['message' => 'Password reset successful'];

        return response($response, 200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        $response = 'Token Invalid';

        return response($response, 401);
    }
}
