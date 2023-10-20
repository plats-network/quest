<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Models\Post as Campain;
use App\Models\Task;
use App\Models\User;
use App\Models\UserReward;
use App\Models\UserTaskStatus;
use Illuminate\Http\JsonResponse;

final class GetItemUseCase
{
    public function handle(Campain $campain): JsonResponse
    {
        $dataCampain = $campain->toArray();
        //Data list tasks
        $dataCampain['tasks'] = $campain->tasks()->get()->toArray();
        $id = $campain->id;

        //List user play
        $listUserID = UserTaskStatus::query()
            ->where('post_id', '=', $id)
            ->get()
            ->pluck('user_id')
            //->unique('user_id')
            ->toArray();

        //Unique value in array
        $listUserID = array_unique($listUserID);

        //Get list user in $listUserID
        $userPlayTasks = User::query()
            ->whereIn('id', $listUserID)
            ->limit(10)
            ->get();
        //Data User Play
        $dataCampain['users_play'] = $userPlayTasks->toArray();
        //List User Win
        //UserReward
        $userRewards = UserReward::query()
            ->where('post_id', '=', $campain->id)
            ->limit(10)
            ->get();
        //Get ids user win
        $listUserWinID = $userRewards->pluck('user_id')->toArray();
        //Get list user win
        $userWinTasks = User::query()
            ->whereIn('id', $listUserWinID)
            ->limit($campain->total_person ?? 5)
            ->get();
        //Data User Win
        $dataCampain['users_reward'] = $userWinTasks->toArray();

        //Check Member Is Play task
        $isWin = false;
        $isReceiveReward = false;

        //Check Member Win task
        //Check Member IS Receive Reward
        $dataCampain['is_win'] = $isWin;
        $dataCampain['is_receive_reward'] = $isReceiveReward;
        //All Task type
        $dataCampain['task_types'] = Task::getTaskType();

        return response()->json($dataCampain);
    }
}
