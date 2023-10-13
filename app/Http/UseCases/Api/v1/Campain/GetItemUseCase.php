<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Campain $campain): JsonResponse
    {
        return response()->json($campain);
    }
}
