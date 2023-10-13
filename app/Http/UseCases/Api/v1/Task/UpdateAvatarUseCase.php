<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Http\Services\FileUploadService;
use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class UpdateAvatarUseCase
{
    use MakeApiResponse;

    public function __construct(
        private readonly FileUploadService $service
    ) {
    }

    public function handle(Task $task, UploadedFile $file): JsonResponse
    {
        if (! $this->service->handle($file, $filename)) {
            return $this->errorResponse('Failed to upload file.', 500);
        }

        if (
            $task->getAttribute('avatar') &&
            Storage::disk('public')->exists($task->getAttribute('avatar'))
        ) {
            Storage::disk('public')->delete($task->getAttribute('avatar'));
        }

        $data['avatar'] = $filename;
        $task->update($data);

        return $this->successResponse('Avatar updated successfully.');
    }
}
