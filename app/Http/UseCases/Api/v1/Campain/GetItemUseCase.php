<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Resources\Api\v1\TaskCollection;
use App\Models\Post;
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
        $userWinTasks = [];
        //For each user win
        foreach ($listUserWinID as $id) {

            $user = User::query()
                ->where('id', '=', $id)
                ->first();

            $modelReward = UserReward::query()
                ->where('post_id', '=', $campain->id)
                ->where('user_id', '=', $user->id)
                ->first();

            //Push user to array
            $itemUserWin = [
                'user_id' => $user->id,
                //Wallet Address
                'wallet_address' => $user->wallet_address,
                "reward_type"=>  $campain->reward_type,
                "block_chain_network"=>  $campain->block_chain_network,
                "category_token"=>  $campain->category_token,
                "comapain_total_token"=>  $campain->total_token,

                'user_name' => $user->first_name . ' ' . $user->last_name,
                'total_point' => $modelReward->total_point,
                'total_token' => $modelReward->total_token,
                'date_created' => $modelReward->date_created,
                'date_transfered' => $modelReward->date_transfered,
            ];


            $userWinTasks[] = $itemUserWin;
        }

        //Check empty User Win then fake data -24.10.2023
        if (empty($userWinTasks)) {
            //{
            //            "user_id": 8,
            //            "wallet_address": "5Fbgdek6QeFodSo1LpNitvLKGjufXKWWRQ9Uw4TdKVeox8T2",
            //            "reward_type": "NTF",
            //            "block_chain_network": "PHALA",
            //            "category_token": null,
            //            "comapain_total_token": 10000,
            //            "user_name": "Account 1 Account 1",
            //            "total_point": null,
            //            "total_token": 10000,
            //            "date_created": "2023-10-24 03:11:45",
            //            "date_transfered": null
            //        }
            $userWinTasks = [
                [
                    'user_id' => 3,
                    //Wallet Address
                    'wallet_address' => '5G4URyHwDkRy29QvtofisCZhjqdjyUYMpvAUzzpBnhMNnY4z',
                    "reward_type"=>  $campain->reward_type,
                    "block_chain_network"=>  $campain->block_chain_network,
                    "category_token"=>  $campain->category_token,
                    "comapain_total_token"=>  $campain->total_token,

                    'user_name' =>'Dung',
                    'total_point' => 0,
                    'total_token' => 0,
                    'date_created' => null,
                    'date_transfered' => null,
                ],
                [
                    'user_id' => 5,
                    //Wallet Address
                    'wallet_address' => '5Cu5qz2GSd1kaQFGiuqhKvTR2K7tJsrmffpfb6DFiwWoBcqt',
                    "reward_type"=>  $campain->reward_type,
                    "block_chain_network"=>  $campain->block_chain_network,
                    "category_token"=>  $campain->category_token,
                    "comapain_total_token"=>  $campain->total_token,

                    'user_name' => 'Chinh',
                    'total_point' => 100,
                    'total_token' => 100,
                    'date_created' => null,
                    'date_transfered' => null,
                ]
            ];
        }

        //Data User Win
        $dataCampain['users_reward'] = $userWinTasks;

        //Check Member Is Play task
        $isWin = false;
        $isReceiveReward = false;

        //Check Member Win task
        //Check Member IS Receive Reward
        $dataCampain['is_win'] = $isWin;
        $dataCampain['is_receive_reward'] = $isReceiveReward;
        //All Task type
        //$dataCampain['task_types'] = Task::getTaskType();
        //All Category Token
        //$dataCampain['category_tokens'] = Post::getAllCategoryToken();

        return response()->json($dataCampain);
    }
}
