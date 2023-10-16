<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
use App\Notifications\AccountDeleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

final class DeleteUseCase
{
    use MakeApiResponse;

    public function handle(Task $task): JsonResponse
    {
        $task->delete();

        /*Notification::route('mail', $task->getAttribute('email'))
            ->notify(new AccountDeleted());*/

        return $this->successResponse('Task deleted successfully.');
    }
}
