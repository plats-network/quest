<?php

namespace App\Space\TelegramLoginAuth\Providers;

use App\Space\TelegramLoginAuth\Contracts\Validation\ValidatorChain as ValidatorChainContract;
use App\Space\TelegramLoginAuth\Validation\ValidatorChain;
use Illuminate\Support\ServiceProvider;

final class LaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->getPackageConfigPath() => $this->app->configPath('telegram_login_auth.php'),
            ], 'config');
        }
    }

    private function getPackageConfigPath(): string
    {
        return dirname(__DIR__).'/config/telegram_login_auth.php';
    }

    public function register(): void
    {
        $this->mergeConfigFrom($this->getPackageConfigPath(), 'telegram_login_auth');

        $this->app->bind(ValidatorChainContract::class, ValidatorChain::class);
    }
}
