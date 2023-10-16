<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
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

        //dd($data);
        //array:10 [▼ // app\Http\Controllers\Backend\TasksController.php:341
        //  "_method" => "PATCH"
        //  "_token" => "rNTfIojAK3y2zqvd9sClDcx5AaON54jZJPipHVh7"
        //  "post_id" => "17"
        //  "name" => "Token Holder"
        //  "description" => "DerpDEXcom’s Tweet retweeters"
        //  "entry_type" => "10"
        //  "value" => "https://twitter.com/intent/retweet?tweet_id=1708779829368357330"
        //  "status" => "Active"
        //  "block_chain_network" => "1"
        //  "total_token" => "6"
        //]
        //$data['password'] = bcrypt($password);
        //$data['email_verified_at'] = now();

        $data['post_id'] = $data['post_id'];
        $data['name'] = $data['name'];
        $data['description'] = $data['description'];
        $data['entry_type'] = $data['entry_type'];
        $data['value'] = $data['value'];
        $data['status'] = $data['status'];
        $data['block_chain_network'] = $data['block_chain_network'];
        $data['total_token'] = $data['total_token'];

        $task = Task::factory()->create($data);

        //Notification::send($task, new AccountCreated($password));

        return $this->successResponse('Task created successfully.', $task);
    }
}
