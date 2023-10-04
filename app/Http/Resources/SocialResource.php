<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'discord' => $this->discord,
            'telegram' => $this->telegram,
        ];
    }
}
