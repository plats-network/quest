<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Task $task): JsonResponse
    {
        return response()->json($task);
    }
}
