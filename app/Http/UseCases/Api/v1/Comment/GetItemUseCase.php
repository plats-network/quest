<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Comment;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Comment $comment): JsonResponse
    {
        return response()->json($comment);
    }
}
