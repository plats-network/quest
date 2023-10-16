<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Category;

use App\Http\Shared\MakeApiResponse;
use App\Models\Category;
use App\Notifications\AccountDeleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

final class DeleteUseCase
{
    use MakeApiResponse;

    public function handle(Category $category): JsonResponse
    {
        $category->delete();

        /*Notification::route('mail', $category->getAttribute('email'))
            ->notify(new AccountDeleted());*/

        return $this->successResponse('Category deleted successfully.');
    }
}
