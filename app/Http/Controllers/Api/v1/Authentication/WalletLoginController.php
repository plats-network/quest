<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Authentication;

use App\Http\Controllers\Api\v1\Controller;
use App\Http\Requests\Api\v1\Authentication\WalletLoginRequest;
use App\Http\UseCases\Api\v1\Authentication\WalletLoginUseCase;
use Illuminate\Http\JsonResponse;

/**
 * @group Authentication
 */
class WalletLoginController extends Controller
{
    public function __invoke(WalletLoginRequest $request, WalletLoginUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }
}
