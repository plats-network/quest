<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Http\Shared\MakeApiResponse;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Tag $tag, array $data): JsonResponse
    {
        $tag->update($data);

        return $this->successResponse('Tag updated successfully.');
    }
}
