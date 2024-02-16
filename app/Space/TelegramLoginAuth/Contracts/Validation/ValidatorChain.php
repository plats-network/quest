<?php

namespace App\Space\TelegramLoginAuth\Contracts\Validation;

use App\Space\TelegramLoginAuth\Contracts\Telegram\Entity;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\Rule as RuleContract;

interface ValidatorChain
{
    public function addRule(RuleContract $rule): void;

    public function validate(Entity $entity): void;
}
