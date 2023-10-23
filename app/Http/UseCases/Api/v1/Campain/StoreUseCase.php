<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use App\Notifications\AccountCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class StoreUseCase
{
    use MakeApiResponse;

    public function handle(array $data): JsonResponse
    {
        //Log data
        Log::info('Submit data', $data);

        $dataTask = $data['tasks'];

        // "name" : "Transaction",
        // "description" : "Note",
        // "entry_type" : "TWITTER_FOLLOW",
        // "value" : "https://twitter.com/intent/follow?screen_name=BreederDodo",
        // "status" : "Active",
        // "block_chain_network" : null,
        // "total_token" : "6"
        //For each task. check empty name then add
        foreach ($dataTask as $key => $task) {
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
        //dd($dataTask);

        unset($data['tasks']);
        $password = Str::password(8);
        //Upload thumbnail image
        if (isset($data['thumbnail'])) {
            $data['featured_image'] = $this->saveImgBase64($data['thumbnail'], 'thumbnail');
        }
        //Unset data files
        unset($data['thumbnail']);
        unset($data['files']);
        //tags_list
        unset($data['tags_list']);


        //$data['password'] = bcrypt($password);
        //$data['email_verified_at'] = now();

        $campain = Campain::factory()->create($data);
        //Store Task
        $campain->tasks()->createMany($dataTask);

        //Notification::send($campain, new AccountCreated($password));
        $dataReturn = $campain->toArray();
        //Data list tasks
        $dataReturn['tasks'] = $campain->tasks()->get()->toArray();

        return $this->successResponse('Campain created successfully.', $campain);
    }

    protected function saveImgBase64($content, $folder)
    {
        //Log content
        //Log::info($content);
        //Remover text data:image/webp;base64, from content
        $content = str_replace('data:image/webp;base64,', '', $content);
        $content = str_replace('data:image/png;base64,', '', $content);
        $content = str_replace('data:image/jpeg;base64,', '', $content);
        $content = str_replace('data:image/gif;base64,', '', $content);
        $extension = '.jpg';

        preg_match('/.([0-9]+) /', microtime(), $m);

        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $extension);

        $storage = Storage::disk('cloudinary2');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $fileNameSave =$folder . '/' . $fileName;
        $storage->put($fileNameSave, base64_decode($content), 'public');
        $fullURL = Storage::disk('cloudinary2')->url($fileNameSave);
        //Log Full Url
        Log::info($fullURL);


        return $fullURL;
    }
}
