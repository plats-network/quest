<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Authentication;

use App\Http\Shared\MakeApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

final class WalletRegisterUseCase
{
    use MakeApiResponse;

    public function handle(array $data): JsonResponse
    {
        //$user = User::factory()->create($data);
        //$user->sendEmailVerificationNotification();
        $wallet_address = $data['wallet_address'];
        //wallet_name
        $wallet_name = $data['wallet_name'];
        //Check user by wallet_address and wallet_name in db
        //If not exist then create new user
        //If exist then login
        //If login success then redirect to home page
        //If login fail then redirect to login page
        $user = User::where('wallet_address', $wallet_address)
            ->where('wallet_name', $wallet_name)
            ->first();
        if ($user) {
            //login
            //Auth::guard('quest')->login($user);
            //return redirect()->route('quest.home');
            //Send failed response if request invalid
           /* return $this->errorResponse([
                'message' => 'User already exist.',
            ], 422);*/
        } else {
            //create new user
            $user = new User();
            $user->wallet_address = $wallet_address;
            $user->wallet_name = $wallet_name;

            $password = bcrypt($wallet_address . $wallet_name);

            $user->first_name = $wallet_name;
            $user->last_name = $wallet_name;
            $user->name = $wallet_name;
            $user->email = $wallet_address . $wallet_name . '@gmail.com';
            $user->password = $password;

            $user->save();
            //login
            //Auth::guard('quest')->login($user);
        }

        return $this->successResponse([
            'message' => 'User registered successfully.',
            'token' => $user->createToken(Str::random(15))->plainTextToken,
        ]);
    }
}
