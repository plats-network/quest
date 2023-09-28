<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;

class ForgotPasswordController
{
    protected function sendResetLinkResponse(Request $request, $response)
    {
        $response = ['message' => 'Password reset email sent'];

        return response($response, 200);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $response = 'Email could not be sent to this email address';

        return response($response, 500);
    }
}
