<?php

namespace App\Space\TelegramLoginAuth\Validation;

use App\Space\TelegramLoginAuth\Contracts\Telegram\Entity as EntityContract;
use App\Space\TelegramLoginAuth\Contracts\Validation\Rules\Rule as RuleContract;
use App\Space\TelegramLoginAuth\Contracts\Validation\ValidatorChain as ValidatorChainContract;

final class ValidatorChain implements ValidatorChainContract
{
    /**
     * @var RuleContract[]
     */
    private $rules = [];

    public function addRule(RuleContract $rule): void
    {
        $this->rules[] = $rule;
    }

    public function validate(EntityContract $entity): void
    {
        foreach ($this->rules as $rule) {
            $rule->validate($entity);
        }
    }
}
