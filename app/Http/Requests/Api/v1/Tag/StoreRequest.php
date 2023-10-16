<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Tag;

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
        // "name" => "400USDT"
        //  "slug" => "6523a99ac46ef"
        //  "group_name" => null
        //  "description" => null
        //  "meta_title" => null
        //  "meta_keyword" => null
        //  "meta_description" => null
        //  "status" => "1"
        return [
            //'email' => ['required', 'email', 'unique:users'],
            'name' => 'required',
            'slug' => 'nullable',
            'group_name' => 'nullable',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_keyword' => 'nullable',
            'meta_description' => 'nullable',
            'status' => 'nullable',
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
