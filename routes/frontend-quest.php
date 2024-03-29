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
use App\Facades\Twitter;

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

//Update db
Route::get('update-db', [\App\Http\Controllers\FrontendQuest\FrontendController::class, 'updateDb'])->name('update-db');

//Test twitter
Route::get('/test', function () {

    /*Twitter::tweet(sprintf(
        "Good news"
    ));*/
    $twitterUserID = '1588364698239397888';
    //$response = Twitter::getUserByUsername('larastreamers');
    //Check user follow
    //$response = Twitter::isFollowing($twitterUserID, '1393256216818823169');
    //Get likeds tweet
    //$response = Twitter::getLikedTweets($twitterUserID);
    $twitterID = '1393256216818823169';
    //$response = Twitter::getQuoteTweets($twitterID);
    //https://twitter.com/intent/retweet?tweet_id=1717163107800567924
    $response = Twitter::getRetweetedBy('1712857718367695177');
    dd($response);

    dd('Done');
});


/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['middleware' => ['web'], 'as' => 'quest.', ], function () {

    //Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/', [PostsController::class, 'index'])->name('index');

    Route::get('home', [FrontendController::class, 'index'])->name('home');
    Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
    Route::get('terms', [FrontendController::class, 'terms'])->name('terms');
    //me
    Route::get('me', [FrontendController::class, 'me'])->name('me');
    //support
    Route::get('support', [FrontendController::class, 'support'])->name('support');


    //Wallet Login
    Route::any('wallet-login', [FrontendController::class, 'walletLogin'])->name('wallet-login');

    Route::get('/cookie', function () {
        return \Illuminate\Support\Facades\Cookie::get('referral');
    });

    //https://blog.damirmiladinov.com/laravel/building-laravel-referral-system.html
    Route::get('/referral-program-create', [UserController::class, 'createProgram'])->name('referral-program-create');
    Route::get('/referral-link', [UserController::class, 'referralLink'])->name('referral-link');

    Route::get('/referral', [UserController::class, 'referrals'])->name('referrer');
    Route::get('/referrals', [UserController::class, 'referral'])->name('referrals');

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

    //Connect twitter
    Route::get('connect/twitter', [PostsController::class, 'connectTwitter'])->name('posts.connectTwitter');

    //Task detail
    Route::get('tasks/{id}/{slug?}', [PostsController::class, 'show'])->name('tasks.show');

    //checkStatus
    Route::any('tasks/checkStatus', [PostsController::class, 'checkStatus'])->name('tasks.checkStatus');

    //$user->favorite($post);
    Route::post('posts/favorite', [PostsController::class, 'favoritePost'])->name('posts.favoritePost');

    //starQuest
    Route::post('posts/starQuest', [PostsController::class, 'starQuest'])->name('posts.starQuest');

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
