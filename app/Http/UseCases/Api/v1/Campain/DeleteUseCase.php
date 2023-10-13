<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use App\Notifications\AccountDeleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

final class DeleteUseCase
{
    use MakeApiResponse;

    public function handle(Campain $campain): JsonResponse
    {
        $campain->delete();

        Notification::route('mail', $campain->getAttribute('email'))
            ->notify(new AccountDeleted());

        return $this->successResponse('Campain deleted successfully.');
    }
}
