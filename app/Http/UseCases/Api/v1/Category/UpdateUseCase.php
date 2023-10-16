<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Category;

use App\Http\Shared\MakeApiResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Category $category, array $data): JsonResponse
    {
        $category->update($data);

        return $this->successResponse('Category updated successfully.', $category);
    }
}
