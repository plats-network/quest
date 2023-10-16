<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Comment;

use App\Http\Shared\MakeApiResponse;
use App\Models\Comment;
use App\Notifications\AccountDeleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

final class DeleteUseCase
{
    use MakeApiResponse;

    public function handle(Comment $comment): JsonResponse
    {
        $comment->delete();

        /*Notification::route('mail', $comment->getAttribute('email'))
            ->notify(new AccountDeleted());*/

        return $this->successResponse('Comment deleted successfully.');
    }
}
