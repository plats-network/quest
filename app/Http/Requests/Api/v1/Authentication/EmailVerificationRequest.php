<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Authentication;

use App\Http\Shared\MakeApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailVerificationRequest extends FormRequest
{
    use MakeApiResponse;

    public function authorize(): bool
    {
        if (! hash_equals((string) $this->route('id'), (string) $this->user('sanctum')->getKey())) {
            return false;
        }

        if (! hash_equals((string) $this->route('hash'), sha1($this->user('sanctum')->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    protected function fulfill(): void
    {
        if (! $this->user('sanctum')->hasVerifiedEmail()) {
            $this->user('sanctum')->markEmailAsVerified();
        }
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
