<?php

declare(strict_types=1);

use App\Http\Controllers\Api\v1\Authentication\LoginController;
use App\Http\Controllers\Api\v1\Authentication\WalletRegisterController;
use App\Http\Controllers\Api\v1\Authentication\WalletLoginController;
use App\Http\Controllers\Api\v1\Authentication\LogoutController;
use App\Http\Controllers\Api\v1\Authentication\RegisterController;
use App\Http\Controllers\Api\v1\Authentication\ResetPasswordController;
use App\Http\Controllers\Api\v1\Authentication\VerifyEmailController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\CampainController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TelegramBotController;

//Ping
Route::get('ping', function () {
    return ['pong' => true];
});

//Authentication routes
Route::post('login', LoginController::class);

Route::post('register', RegisterController::class);

Route::post('wallet-login', WalletLoginController::class);

Route::post('wallet-register', WalletRegisterController::class);

Route::post('connect-wallet', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'connectWallet'])->name('connect-wallet');

//Get campain infor to show reward type. block chain network, total token, total person
Route::get('get-campain-infor', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'getCampainInfor'])->name('get-campain-infor');

//Update user reward status
Route::post('update-user-reward-status', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'updateUserRewardStatus'])->name('update-user-reward-status');

//Update quest deposit status
Route::post('update-quest-deposit-status', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'updateQuestDepositStatus'])->name('update-quest-deposit-status');

Route::get('users', function () {
    // Route assigned name "admin.users"...
})->name('users');

//Update Post total token and block chain network
Route::post('update-post-total-token', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'updatePostTotalToken'])->name('update-post-total-token');


Route::get('/', function () {
    $arrApi = [
        'connect-wallet' => [
            'method' => 'POST',
            'url' => '/api/v1/wallet-login',
            'params' => [
                'wallet_address' => 'string',
                'wallet_name' => 'string',
            ],
            'response' => [
                'message' => 'string',
                'token' => 'string',
                'user' => 'object',
            ],
        ],
        'register' => [
            'method' => 'POST',
            'url' => '/api/v1/register',
            'params' => [
                'name' => 'string',
                'email' => 'string',
                'password' => 'string',
                'password_confirmation' => 'string',
            ],
            'response' => [
                'message' => 'string',
                'token' => 'string',
            ],
        ],
    ];
    return [
        'message' => 'Hello World. API Working fine!',
        'date_update' => '2023-10-16',
        'api' => $arrApi
    ];
});

Route::get('send-message', [TelegramBotController::class, 'sendMessage'])->name('telegrapSendActivity');
Route::get('telegram-info', [TelegramBotController::class, 'index'])->name('telegramInfo');
Route::get('set-bot-webhook', [TelegramBotController::class, 'setConfigData'])->name('setBotInfo');
Route::get('get-bot-info', [TelegramBotController::class, 'getWebhookInfo'])->name('getBotInFor');

//Get  chat member
Route::get('get-chat-member', [TelegramBotController::class, 'getChatMember'])->name('getChatMember');


Route::prefix('email')
    ->group(function () {
        Route::post('verification-notification', [VerifyEmailController::class, 'notify']);
        Route::get('verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->name('verification.verify');
    });

Route::prefix('password')
    ->group(function () {
        Route::post('reset-notification', [ResetPasswordController::class, 'notify']);
        Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

//User routes
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::post('logout', LogoutController::class);

        Route::patch('users/{user}/avatar', [UserController::class, 'updateAvatar']);

        //Update user Profile Info
        Route::post('update-user-profile', [UserController::class, 'updateUserProfile'])->name('update-user-profile');

        Route::apiResource('users', UserController::class);

        //Category routes
        Route::apiResource('categories', CategoryController::class);

        //tag
        Route::apiResource('tags', TagController::class);

        //campain
        Route::apiResource('campains', CampainController::class)
            ->except('index', 'show');

        //ajaxStartLuckyDraw
        Route::post('campains/lucky-draw', [CampainController::class, 'luckyDraw'])->name('posts.ajaxStartLuckyDraw');

        //Update is_prize
        Route::post('campains/update-is-prize', [CampainController::class, 'updateIsPrize'])->name('posts.updateIsPrize');

        //Task
        Route::apiResource('tasks', TaskController::class);

        //comment
        Route::apiResource('comments', CommentController::class);

        //like
        //Route::apiResource('likes', LikeController::class);
    });

//Not Need Authentication
//campains Index set withouth auth
Route::get('campains', [CampainController::class, 'index']);
//Show
Route::get('campains/{campain}', [CampainController::class, 'show']);

//Telegram webhook
Route::post('telegram-webhook', [\App\Http\Controllers\Api\v1\TelegramController::class, 'webhook']);

//Telegram set webhook
Route::get('telegram-set-webhook', [\App\Http\Controllers\Api\v1\TelegramController::class, 'setWebhook']);

//API Token Holder
Route::get('token-holders', [\App\Http\Controllers\Api\v1\Wallet\TokenHolderController::class, 'index']);
