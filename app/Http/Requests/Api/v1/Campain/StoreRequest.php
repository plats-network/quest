<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\v1\Campain;

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
}
