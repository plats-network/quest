<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Campain $campain, array $data): JsonResponse
    {
        //Log data
        Log::info('Submit data', $data);

        //Upload thumbnail image
        if (isset($data['thumbnail'])) {
            $data['featured_image'] = saveImgBase64($data['thumbnail'], 'thumbnail');
        }

        //Unset data files
        unset($data['thumbnail']);
        unset($data['files']);
        //tags_list
        unset($data['tags_list']);
        $dataTask = $data['tasks'];
        foreach ($dataTask as $key => $task) {
            //Todo move to validate
            if (empty($task['name'])) {
                //Case entry type TWITTER_FOLLOW
                if ($task['entry_type'] == 'TWITTER_FOLLOW') {
                    //Get screen_name from value
                    $screenName = Str::after($task['value'], 'screen_name=');
                    $dataTask[$key]['name'] = 'Follow Twitter' . ' ' . $screenName;
                }
                //Case entry type TWITTER_LIKE
                if ($task['entry_type'] == 'TWITTER_LIKE') {
                    //Get screen_name from value
                    $screenName = Str::after($task['value'], 'screen_name=');
                    $dataTask[$key]['name'] = 'Like Twitter' . ' ' . $screenName;
                }
                //Case entry type TWITTER_RETWEET
                if ($task['entry_type'] == 'TWITTER_RETWEET') {
                    //Get screen_name from value
                    $screenName = Str::after($task['value'], 'screen_name=');
                    $dataTask[$key]['name'] = 'Retweet Twitter' . ' ' . $screenName;
                }

            }
        }
        unset($data['tasks']);

        //$data['password'] = bcrypt($password);
        //$data['email_verified_at'] = now();

        $campain->update($data);
        //Clear old task
        $campain->tasks()->delete();
        //Store Task
        $campain->tasks()->createMany($dataTask);

        //Notification::send($campain, new AccountCreated($password));
        $dataReturn = $campain->toArray();
        //Data list tasks
        $dataReturn['tasks'] = $campain->tasks()->get()->toArray();

        return $this->successResponse('Campain updated successfully.', $campain);
    }
}
