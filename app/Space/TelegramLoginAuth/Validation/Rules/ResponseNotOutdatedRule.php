<?php

namespace App\Space\TelegramLoginAuth\Validation\Rules;

use App\Space\TelegramLoginAuth\Contracts\Telegram\Entity as EntityContract;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\ResponseOutdatedException;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\Rule as RuleContract;
use Illuminate\Support\Carbon;

class ResponseNotOutdatedRule implements RuleContract
{
    public function validate(EntityContract $entity): void
    {
        if (! Carbon::now('UTC')->lessThanOrEqualTo($entity->getAuthDate()->addHour())) {
            throw new ResponseOutdatedException();
        }
    }
}
