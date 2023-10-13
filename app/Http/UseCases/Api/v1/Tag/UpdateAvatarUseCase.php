<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Http\Services\FileUploadService;
use App\Http\Shared\MakeApiResponse;
use App\Models\Tag;
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

    public function handle(Tag $tag, UploadedFile $file): JsonResponse
    {
        if (! $this->service->handle($file, $filename)) {
            return $this->errorResponse('Failed to upload file.', 500);
        }

        if (
            $tag->getAttribute('avatar') &&
            Storage::disk('public')->exists($tag->getAttribute('avatar'))
        ) {
            Storage::disk('public')->delete($tag->getAttribute('avatar'));
        }

        $data['avatar'] = $filename;
        $tag->update($data);

        return $this->successResponse('Avatar updated successfully.');
    }
}
