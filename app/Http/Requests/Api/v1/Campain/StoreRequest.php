<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Campain;

use App\Enums\UserRole;
use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    use MakeApiResponse;

    public function authorize(): bool
    {
        return $this
            ->user('sanctum')
            ->hasRole(UserRole::ADMIN->value);
    }

    public function rules(): array
    {
        //  "name" => "🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia"
        //  "intro" => "Introduction of 🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia"
        //  "content" => "Content of 🎁Earn Your Metaverse Passport: SecondLive on Scroll Sepolia"
        //  "files" => null
        //  "featured_image" => "/storage/photos/2/651f95c5e8f2a.jpg"
        //  "category_id" => "7"
        //  "tags_list" => array:1 [▶]
        //  "reward_type" => "1"
        //  "block_chain_network" => "1"
        //  "total_token" => "500"
        //  "total_person" => "10"
        //  "status" => "1"
        //  "published_at" => "2023-10-09T07:19:55"
        //  "start_at" => "2023-10-09T07:19:55"
        //  "end_at" => "2023-11-09T07:19:55"
        return [
            'name' => 'required',
            'intro' => 'nullable',
            'content' => 'nullable',
            'files' => 'nullable',
            'thumbnail' => 'nullable',
            'featured_image' => 'nullable',
            'category_id' => 'nullable',
            'tags_list' => 'nullable',
            'reward_type' => 'nullable',
            'block_chain_network' => 'nullable',
            'category_token' => 'nullable',
            'total_token' => 'nullable',
            'total_person' => 'nullable',
            'status' => 'nullable',
            'published_at' => 'nullable',
            'start_at' => 'nullable',
            'end_at' => 'nullable',
            //tasks array
            'tasks' => 'nullable|array',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse($validator->errors()->toArray(), 422)
        );
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            /*$date = $validator->safe()->date;

            if(strtotime($date) < strtotime('now')) {
                $validator->errors()->add('date', 'Date should be in the future.');
            }*/
            //Validate Task Item
            $taskTypes = Task::getTaskType();
            //All task network name
            $taskNetworks = Task::getAllNetworkName();
            $tasks = $validator->safe()->tasks;
            //Foreach tasks then check entry type task
            foreach ($tasks as $task) {
                //Check entry type task
                //Check entry_type in key value of $taskTypes
                if (isset($task['entry_type']) && !array_key_exists($task['entry_type'], $taskTypes)){
                    $arrStringKeyValid = implode(', ', array_keys($taskNetworks));
                    $msgError = 'Entry type ' . $task['entry_type'] .' is invalid. Need In' . $arrStringKeyValid;
                    //Add Extra list key value
                    $arrKeyValid = array_keys($taskTypes);
                    $validator->errors()->add('entry_type', $msgError);
                }

                //Check task value url is valid twitter url
                $isTwitterTask = Task::TYPE_TWITTER_FOLLOW  ||
                    Task::TYPE_TWITTER_LIKE ||
                    Task::TYPE_TWITTER_RETWEET ||
                    Task::TYPE_TWITTER_HASHTAG;

                if ($isTwitterTask) {
                    //Check valid twitter url
                    //https://twitter.com/intent/like?tweet_id=1708779829368357330
                    //https://twitter.com/intent/follow?screen_name=BreederDodo
                    //https://twitter.com/intent/retweet?tweet_id=1708779829368357330
                    //Check contain text twitter.com or x.com
                    if (strpos($task['value'], 'twitter.com') === false && strpos($task['value'], 'x.com') === false){
                        $validator->errors()->add('value', 'Twitter url ' . $task['value'] .' is invalid.');
                    }
                }

                //Check key block_chain_network in $taskNetworks
                if (isset($task['block_chain_network']) && !array_key_exists($task['block_chain_network'], $taskNetworks)){
                    $arrStringKeyValid = implode(', ', array_keys($taskNetworks));
                    $msgError = 'Block chain network ' . $task['block_chain_network'] .' is invalid. Need In' . $arrStringKeyValid;
                    //Add Extra list key value
                    $arrKeyValid = array_keys($taskNetworks);
                    $validator->errors()->add('block_chain_network', $msgError);
                }
            }

        });
    }
}
