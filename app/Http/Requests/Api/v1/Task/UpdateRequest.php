<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Task;

use App\Http\Shared\MakeApiResponse;
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
        //return $this->route('tasks')->id === $this->user('sanctum')->id;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'entry_type' => 'required',
            'value' => 'required',
            'status' => 'required',
            'block_chain_network' => 'required',
            'total_token' => 'required',
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
}
