<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Task $task, array $data): JsonResponse
    {
        $task->update($data);

        return $this->successResponse('Task updated successfully.', $task);
    }
}
