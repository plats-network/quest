<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Campain;

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
        //return $this->route('user')->id === $this->user('sanctum')->id;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'intro' => 'nullable',
            'content' => 'nullable',
            'files' => 'nullable',
            'featured_image' => 'nullable',
            'category_id' => 'nullable',
            'tags_list' => 'nullable',
            'reward_type' => 'nullable',
            'block_chain_network' => 'nullable',
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
}
