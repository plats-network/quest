<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Authentication;

use App\Http\Shared\MakeApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class WalletLoginUseCase
{
    use MakeApiResponse;

    public function handle(array $data): JsonResponse
    {
        $wallet_address = $data['wallet_address'];
        //wallet_name
        $wallet_name = $data['wallet_name'];
        $user = User::query()
            ->where('wallet_address', $wallet_address)
            ->first();

        if (! $user) {
            return $this->errorResponse('Incorrect mail address or password.', 401);
        }

        return $this->successResponse([
            'message' => 'User logged in successfully.',
            'token' => $user->createToken(Str::random())->plainTextToken,
            'user' => $user,
        ]);
    }
}
