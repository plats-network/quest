<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\User;

use App\Http\Shared\MakeApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(User $user, array $data): JsonResponse
    {
        $user->update($data);
        //Save avatar_url
        if (isset($data['avatar_url'])) {
            $user->avatar_url =saveImgBase64($data['avatar_url'], 'thumbnail');
            $user->save();
        }


        return $this->successResponse('User updated successfully.');
    }
}
