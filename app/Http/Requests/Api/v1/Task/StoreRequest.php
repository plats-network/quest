<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Task;

use App\Enums\UserRole;
use App\Http\Shared\MakeApiResponse;
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
        // "post_id" : "17",
        //  "name" : "Token Holder",
        //  "description" : "DerpDEXcom’s Tweet retweeters",
        //  "entry_type" : "10",
        //  "value" : "https://twitter.com/intent/retweet?tweet_id=1708779829368357330",
        //  "status" : "Active",
        //  "block_chain_network" : "1",
        //  "total_token" : "6"
        return [
            //'email' => ['required', 'email', 'unique:users'],
            'post_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'entry_type' => 'required',
            'value' => 'required',
            'status' => 'required',
            'block_chain_network' => 'required',
            'total_token' => 'required',
            //'role' => ['required', Rule::in(UserRole::getValues())],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse($validator->errors()->toArray(), 422)
        );
    }
}
