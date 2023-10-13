<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Services\FileUploadService;
use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
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

    public function handle(Campain $campain, UploadedFile $file): JsonResponse
    {
        if (! $this->service->handle($file, $filename)) {
            return $this->errorResponse('Failed to upload file.', 500);
        }

        if (
            $campain->getAttribute('avatar') &&
            Storage::disk('public')->exists($campain->getAttribute('avatar'))
        ) {
            Storage::disk('public')->delete($campain->getAttribute('avatar'));
        }

        $data['avatar'] = $filename;
        $campain->update($data);

        return $this->successResponse('Avatar updated successfully.');
    }
}
