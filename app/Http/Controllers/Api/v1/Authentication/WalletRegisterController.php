<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Authentication;

use App\Http\Controllers\Api\v1\Controller;
use App\Http\Requests\Api\v1\Authentication\WalletRegisterRequest;
use App\Http\UseCases\Api\v1\Authentication\WalletRegisterUseCase;
use Illuminate\Http\JsonResponse;

/**
 * @group Authentication
 */
class WalletRegisterController extends Controller
{
    public function __invoke(WalletRegisterRequest $request, WalletRegisterUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }
}
