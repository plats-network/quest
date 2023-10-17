<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use App\Notifications\AccountCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

final class StoreUseCase
{
    use MakeApiResponse;

    public function handle(array $data): JsonResponse
    {
        $password = Str::password(8);
        //Unset data files
        unset($data['files']);
        //tags_list
        unset($data['tags_list']);

        //$data['password'] = bcrypt($password);
        //$data['email_verified_at'] = now();

        $campain = Campain::factory()->create($data);
        //Store Task
        //$campain->tasks()->createMany($data['tasks']);

        //Notification::send($campain, new AccountCreated($password));

        return $this->successResponse('Campain created successfully.', $campain);
    }
}
