<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Http\Shared\MakeApiResponse;
use App\Models\Tag;
use App\Notifications\AccountCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

final class StoreUseCase
{
    use MakeApiResponse;

    public function handle(array $data): JsonResponse
    {
        $password = Str::password(8);

        $data['password'] = bcrypt($password);
        $data['email_verified_at'] = now();

        $tag = Tag::factory()->create($data);
        Notification::send($tag, new AccountCreated($password));

        return $this->successResponse('Tag created successfully.');
    }
}
