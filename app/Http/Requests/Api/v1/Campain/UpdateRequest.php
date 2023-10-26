<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
{
    use MakeApiResponse;

    public function authorize(): bool
    {
        return true;
        //return $this->route('user')->id === $this->user('sanctum')->id;
    }

    public function rules(): array
    {
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
            'tasks' => 'nullable|array',
        ];
    }

    protected function passedValidation(): void
    {
        if (! is_null($this->get('password'))) {
            $this->replace([
                'password' => bcrypt($this->get('password')),
            ]);
        }
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
            $taskNetworks = Task::getAllNetworkName();
            $tasks = $validator->safe()->tasks;
            //Foreach tasks then check entry type task
            foreach ($tasks as $task) {
                //Check entry type task
                //Check entry_type in key value of $taskTypes
                if (!array_key_exists($task['entry_type'], $taskTypes)){
                    $validator->errors()->add('entry_type', 'Entry type ' . $task['entry_type'] .' is invalid.');
                }
            }
            //Check key block_chain_network in $taskNetworks
            if (!array_key_exists($task['block_chain_network'], $taskNetworks)){
                $msgError = 'Block chain network ' . $task['block_chain_network'] .' is invalid.';
                //Add Extra list key value
                $arrKeyValid = array_keys($taskNetworks);
                $validator->errors()->add('block_chain_network', $msgError);
            }
        });
    }
}
