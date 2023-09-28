<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Backend\AuthController;
use App\Http\Controllers\Api\Backend\UserController;
use App\Http\Controllers\Api\Backend\AccountController;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forget', [AuthController::class, 'forget']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::get('me', [AuthController::class, 'me']);

    //List user
    Route::get('list', [AuthController::class, 'listUser']);
});
//login
Route::post('login', [AuthController::class, 'loginForm'])->name('login');

Route::get('user', [UserController::class, 'read'])->middleware('jwt.verify');
Route::post('user/create', [UserController::class, 'create'])->middleware('jwt.verify');
Route::post('user/update/{id}', [UserController::class, 'update'])->middleware('jwt.verify');
Route::get('user/delete/{id}', [UserController::class, 'delete'])->middleware('jwt.verify');
Route::get('user/search', [UserController::class, 'search'])->middleware('jwt.verify');


Route::post('account/update', [AccountController::class, 'update'])->middleware('jwt.verify');
Route::put('account/change_password', [AccountController::class, 'password_change'])->middleware('jwt.verify');


//Fallback route
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact'
    ], 404);
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
