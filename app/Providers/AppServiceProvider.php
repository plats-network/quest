<?php

namespace App\Providers;

use App\Space\TelegramLoginAuth\Contracts\Validation\ValidatorChain as ValidatorChainContract;
use App\Space\TelegramLoginAuth\Validation\ValidatorChain;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //Telegram Login Auth
        $this->app->bind(ValidatorChainContract::class, ValidatorChain::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        URL::forceScheme('https');
    }
}
