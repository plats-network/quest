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

//Authentication routes
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::post('wallet-login', WalletLoginController::class);

Route::post('wallet-register', WalletRegisterController::class);


Route::get('/', function () {
    $arrApi = [
        'connect-wallet' => route('api.connect-wallet'),
    ];
    return [
        'message' => 'Hello World. API Working fine!',
        'api' => $arrApi
    ];
});

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

        Route::apiResource('users', UserController::class);

        //Category routes
        Route::apiResource('categories', CategoryController::class);

        //tag
        Route::apiResource('tags', TagController::class);

        //campain
        Route::apiResource('campains', CampainController::class);

        //Task
        Route::apiResource('tasks', TaskController::class);

        //comment
        Route::apiResource('comments', CommentController::class);

        //like
        //Route::apiResource('likes', LikeController::class);
    });
