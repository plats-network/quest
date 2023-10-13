<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Comment;

use App\Http\Services\FileUploadService;
use App\Http\Shared\MakeApiResponse;
use App\Models\Comment;
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

    public function handle(Comment $comment, UploadedFile $file): JsonResponse
    {
        if (! $this->service->handle($file, $filename)) {
            return $this->errorResponse('Failed to upload file.', 500);
        }

        if (
            $comment->getAttribute('avatar') &&
            Storage::disk('public')->exists($comment->getAttribute('avatar'))
        ) {
            Storage::disk('public')->delete($comment->getAttribute('avatar'));
        }

        $data['avatar'] = $filename;
        $comment->update($data);

        return $this->successResponse('Avatar updated successfully.');
    }
}
