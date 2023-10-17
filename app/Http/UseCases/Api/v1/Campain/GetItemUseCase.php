<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Campain $campain): JsonResponse
    {
        $dataCampain = $campain->toArray();
        //Data list tasks
        $dataCampain['tasks'] = $campain->tasks()->get()->toArray();

        return response()->json($dataCampain);
    }
}
