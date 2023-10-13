<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Prefix API Router

Route::name('api.')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('me', [UserController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

//Home router
    Route::get('/', function () {
        $arrApi = [
            'connect-wallet' => route('api.connect-wallet'),
        ];
        return [
            'message' => 'Hello World. API Working fine!',
            'api' => $arrApi
        ];
    });

    //Ping
    Route::get('ping', function () {
        return ['pong' => true];
    });

    //API Router
    //API Connect wallet
    /*
     * Sau khi connect xong thì frontend gửi lên backend 2 thông tin:
     * wallet_address và wallet_name (account name: optional)
    Backend xử lý nếu chưa có trong DB thì đăng ký user mới.
    Nếu có rồi thì thôi. Cuối cùng xử lý để sao cho user đó đã ở trạng thái đã login.
     * */
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

});


