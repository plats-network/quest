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


// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

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

    Route::get('/', [FrontendController::class, 'index'])->name('index');

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
