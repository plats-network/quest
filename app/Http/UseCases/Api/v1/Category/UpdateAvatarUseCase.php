<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Category;

use App\Http\Services\FileUploadService;
use App\Http\Shared\MakeApiResponse;
use App\Models\Category;
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

    public function handle(Category $category, UploadedFile $file): JsonResponse
    {
        if (! $this->service->handle($file, $filename)) {
            return $this->errorResponse('Failed to upload file.', 500);
        }

        if (
            $category->getAttribute('avatar') &&
            Storage::disk('public')->exists($category->getAttribute('avatar'))
        ) {
            Storage::disk('public')->delete($category->getAttribute('avatar'));
        }

        $data['avatar'] = $filename;
        $category->update($data);

        return $this->successResponse('Avatar updated successfully.');
    }
}
