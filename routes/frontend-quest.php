<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendQuest\FrontendController;
use App\Http\Controllers\FrontendQuest\CategoriesController;
use App\Http\Controllers\FrontendQuest\CommentsController;
use App\Http\Controllers\FrontendQuest\PostsController;
use App\Http\Controllers\FrontendQuest\TagsController;
use App\Http\Controllers\FrontendQuest\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\GoogleSocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
require __DIR__.'/auth-quest.php';

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('quest.language.switch');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['as' => 'quest.'], function () {

    //Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/', [PostsController::class, 'index'])->name('index');

    Route::get('home', [FrontendController::class, 'index'])->name('home');
    Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
    Route::get('terms', [FrontendController::class, 'terms'])->name('terms');
    //me
    Route::get('me', [FrontendController::class, 'me'])->name('me');
    //support
    Route::get('support', [FrontendController::class, 'support'])->name('support');

    Route::group(['middleware' => ['auth:quest']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', [UserController::class, 'profile'])->name('users.profile');

        Route::get('profile/{id}/edit', [UserController::class, 'profileEdit'])->name('users.profileEdit');

        Route::patch('profile/{id}/edit', [UserController::class, 'profileUpdate'])->name('users.profileUpdate');

        Route::get('profile/changePassword/{username}', [UserController::class, 'changePassword'])->name('users.changePassword');

        Route::patch('profile/changePassword/{username}', [UserController::class, 'changePasswordUpdate'])->name('users.changePasswordUpdate');

        Route::get('users/emailConfirmationResend/{id}', [UserController::class, 'emailConfirmationResend'])->name('users.emailConfirmationResend');

        Route::delete('users/userProviderDestroy', [UserController::class, 'userProviderDestroy'])->name('users.userProviderDestroy');
    });

    /*
    *
    *  Posts Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'posts';
    $controller_name = 'PostsController';
    Route::get('posts', [PostsController::class, 'index'])->name('posts.index');

    Route::get('posts/{id}/{slug?}', [PostsController::class, 'show'])->name('posts.show');

    //Task detail
    Route::get('tasks/{id}/{slug?}', [PostsController::class, 'show'])->name('tasks.show');

    //checkStatus
    Route::post('tasks/checkStatus', [PostsController::class, 'checkStatus'])->name('tasks.checkStatus');
    /*
    *
    *  Categories Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'categories';
    $controller_name = 'CategoriesController';
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('categories/{id}/{slug?}', [CategoriesController::class, 'show'])->name('categories.show');

    /*
     *
     *  Comments Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'comments';
    $controller_name = 'CommentsController';
    Route::get('comments', [CommentsController::class, 'index'])->name('comments.index');

    Route::get('comments/{id}/{slug?}', [CommentsController::class, 'show'])->name('comments.show');

    Route::post('comments', [CommentsController::class, 'store'])->name('comments.store');

    /*
     *
     *  Tags Routes
     *
     * ---------------------------------------------------------------------
     */

    $module_name = 'tags';
    $controller_name = 'TagsController';

    Route::get('tags', [TagsController::class, 'index'])->name('tags.index');

    Route::get('tags/{id}/{slug?}', [TagsController::class, 'show'])->name('tags.show');

});
