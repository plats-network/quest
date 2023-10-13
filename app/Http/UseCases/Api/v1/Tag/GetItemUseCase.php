<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Tag $tag): JsonResponse
    {
        return response()->json($tag);
    }
}
