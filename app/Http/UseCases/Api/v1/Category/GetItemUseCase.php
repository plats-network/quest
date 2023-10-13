<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Category;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Category $category): JsonResponse
    {
        return response()->json($category);
    }
}
