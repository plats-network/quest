<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Tag;

use App\Enums\UserRole;
use App\Http\Shared\MakeApiResponse;
use Illuminate\Foundation\Http\FormRequest;

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
}
