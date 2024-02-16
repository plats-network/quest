<?php

namespace App\Space\TelegramLoginAuth;

use App\Space\TelegramLoginAuth\Contracts\Telegram\Entity as EntityContract;
use App\Space\TelegramLoginAuth\Contracts\Validation\ValidatorChain as ValidatorChainContract;
use App\Space\TelegramLoginAuth\Telegram\EntityFromRequestFactory;
use App\Space\TelegramLoginAuth\Validation\Rules\ResponseNotOutdatedRule;
use App\Space\TelegramLoginAuth\Validation\Rules\SignatureRule;
use Exception;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Http\Request;

final class TelegramLoginAuth
{
    /**
     * @var ConfigContract
     */
    private $config;

    /**
     * @var ValidatorChainContract
     */
    private $validatorChain;

    public function __construct(ConfigContract $config, ValidatorChainContract $validatorChain)
    {
        $this->config = $config;
        $this->validatorChain = $validatorChain;
    }

    /**
     * @return EntityContract|false
     */
    public function validate(Request $request)
    {
        try {
            return $this->validateWithError($request);
        } catch (Exception $exception) {
            //
        }

        return false;
    }

    public function validateWithError(Request $request): EntityContract
    {
        $entity = (new EntityFromRequestFactory($request))->create();

        if ($this->config->get('telegram_login_auth.validate.signature')) {
            $this->validatorChain->addRule(new SignatureRule($this->config->get('telegram_login_auth.token')));
        }

        if ($this->config->get('telegram_login_auth.validate.response_outdated')) {
            $this->validatorChain->addRule(new ResponseNotOutdatedRule());
        }

        $this->validatorChain->validate($entity);

        return $entity;
    }
}
