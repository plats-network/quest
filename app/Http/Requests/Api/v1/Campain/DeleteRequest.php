<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Campain;

use App\Enums\UserRole;
use App\Http\Shared\MakeApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteRequest extends FormRequest
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
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse($validator->errors()->toArray(), 422)
        );
    }

    //Fobidden Error
    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            $this->errorResponse('This action is unauthorized.', 403)
        );
    }
}
