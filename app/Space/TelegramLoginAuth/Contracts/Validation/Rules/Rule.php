<?php

namespace App\Space\TelegramLoginAuth\Contracts\Validation\Rules;

use App\Space\TelegramLoginAuth\Contracts\Telegram\Entity;

interface Rule
{
    public function validate(Entity $entity): void;
}
