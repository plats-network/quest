<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Comment;

use App\Http\Shared\MakeApiResponse;
use App\Models\Comment;
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

        $comment = Comment::factory()->create($data);
        Notification::send($comment, new AccountCreated($password));

        return $this->successResponse('Comment created successfully.');
    }
}
