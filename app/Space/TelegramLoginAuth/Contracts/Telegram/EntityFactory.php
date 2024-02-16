<?php

namespace App\Space\TelegramLoginAuth\Contracts\Telegram;

interface EntityFactory
{
    public function create(): Entity;
}
