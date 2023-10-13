<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Campain $campain, array $data): JsonResponse
    {
        $campain->update($data);

        return $this->successResponse('Campain updated successfully.');
    }
}
