<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Http\Shared\MakeApiResponse;
use App\Models\Tag;
use App\Notifications\AccountDeleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

final class DeleteUseCase
{
    use MakeApiResponse;

    public function handle(Tag $tag): JsonResponse
    {
        $tag->delete();

       /* Notification::route('mail', $tag->getAttribute('email'))
            ->notify(new AccountDeleted());*/

        return $this->successResponse('Tag deleted successfully.');
    }
}
