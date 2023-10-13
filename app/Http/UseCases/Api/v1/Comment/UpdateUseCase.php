<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Comment;

use App\Http\Shared\MakeApiResponse;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Comment $comment, array $data): JsonResponse
    {
        $comment->update($data);

        return $this->successResponse('Comment updated successfully.');
    }
}
