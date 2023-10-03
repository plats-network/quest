<?php

use App\Http\Controllers\FrontendQuest\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FrontendQuest\Auth\ConfirmablePasswordController;
use App\Http\Controllers\FrontendQuest\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\FrontendQuest\Auth\EmailVerificationPromptController;
use App\Http\Controllers\FrontendQuest\Auth\NewPasswordController;
use App\Http\Controllers\FrontendQuest\Auth\PasswordController;
use App\Http\Controllers\FrontendQuest\Auth\PasswordResetLinkController;
use App\Http\Controllers\FrontendQuest\Auth\RegisteredUserController;
use App\Http\Controllers\FrontendQuest\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendQuest\Auth\SocialLoginController;
// Check if registration is enabled
if (user_registration()) {
    Route::middleware('guest:quest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('quest.register');

        Route::post('register', [RegisteredUserController::class, 'store'])->name('quest.register.store');
    });
}

Route::middleware('guest:quest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('quest.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('quest.login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('quest.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('quest.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('quest.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('quest.password.store');
});

Route::middleware('auth:quest')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('quest.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('quest.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('quest.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('quest.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('quest.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('quest.logout');
});


// Social Login Routes
Route::group(['namespace' => 'Auth', 'middleware' => 'guest:quest'], function () {
    Route::get('login/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('quest.social.login');
    Route::get('quest/login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('quest.social.login.callback');
});
