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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {
    Route::get('me', [UserController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

//Home router
Route::get('/', function() {
    return ['message' => 'Hello World. API Working fine!'];
});
//Ping
Route::get('ping', function() {
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

