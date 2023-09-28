<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\NotificationsController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\PostsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\CommentsController;
use App\Http\Controllers\Backend\TagsController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\RolesController;

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('say', function () {
    return 'Hello World';
});
/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group([ 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', [BackendController::class, 'index'])->name('home');

    Route::get('dashboard', [BackendController::class, 'index'])->name('dashboard');

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';

        Route::get('settings-list', [SettingController::class, 'index'])->name('settings.list');
        Route::get('settings-store', [SettingController::class, 'store'])->name('settings.store');

    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';

    Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications.index');

    Route::get('notifications/markAllAsRead', [NotificationsController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::delete('notifications/deleteAll', [NotificationsController::class, 'deleteAll'])->name('notifications.deleteAll');

    Route::get('notifications/{id}', [NotificationsController::class, 'show'])->name('notifications.show');

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';

    Route::get('backups', [BackupController::class, 'index'])->name('backups.index');
    Route::get('backups/create', [BackupController::class, 'create'])->name('backups.create');
    Route::get('backups/download/{file_name}', [BackupController::class, 'download'])->name('backups.download');
    Route::get('backups/delete/{file_name}', [BackupController::class, 'delete'])->name('backups.delete');

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource('roles', RolesController::class);

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';

    // User Profile
    Route::get('users/profile/{id}', [UserController::class, 'profile'])->name('users.profile');

    // User Profile Edit
    Route::get('users/profile/{id}/edit', [UserController::class, 'profileEdit'])->name('users.profileEdit');
    // User Profile Update
    Route::patch('users/profile/{id}/edit', [UserController::class, 'profileUpdate'])->name('users.profileUpdate');

    Route::get('users/emailConfirmationResend/{id}', [UserController::class, 'emailConfirmationResend'])->name('users.emailConfirmationResend');
    Route::delete('users/userProviderDestroy', [UserController::class, 'userProviderDestroy'])->name('users.userProviderDestroy');

    Route::get('users/profile/changeProfilePassword/{id}', [UserController::class, 'changeProfilePassword'])->name('users.changeProfilePassword');
    Route::patch('users/profile/changeProfilePassword/{id}', [UserController::class, 'changeProfilePasswordUpdate'])->name('users.changeProfilePasswordUpdate');

    Route::get('users/changePassword/{id}', [UserController::class, 'changePassword'])->name('users.changePassword');
    Route::patch('users/changePassword/{id}', [UserController::class, 'changePasswordUpdate'])->name('users.changePasswordUpdate');

    Route::get('users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::patch('users/trashed/{id}', [UserController::class, 'restore'])->name('users.restore');

    Route::get('users/index_data', [UserController::class, 'index_data'])->name('users.index_data');
    Route::get('users/index_list', [UserController::class, 'index_list'])->name('users.index_list');

    Route::resource('users', UserController::class);

    Route::patch('users/{id}/block', [UserController::class, 'block'])->name('users.block')->middleware('permission:block_users');
    Route::patch('users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock')->middleware('permission:block_users');


    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'posts';
    $controller_name = 'PostsController';

    Route::get('posts/index_list', [PostsController::class, 'index_list'])->name('posts.index_list');

    Route::get('posts/index_data', [PostsController::class, 'index_data'])->name('posts.index_data');

    Route::get('posts/trashed', [PostsController::class, 'trashed'])->name('posts.trashed');

    Route::patch('posts/trashed/{id}', [PostsController::class, 'restore'])->name('posts.restore');

    Route::resource('posts', PostsController::class);


    /*
     *
     *  Categories Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'categories';
    $controller_name = 'CategoriesController';

    Route::get('categories/index_list', [CategoriesController::class, 'index_list'])->name('categories.index_list');

    Route::get('categories/index_data', [CategoriesController::class, 'index_data'])->name('categories.index_data');

    Route::get('categories/trashed', [CategoriesController::class, 'trashed'])->name('categories.trashed');

    Route::patch('categories/trashed/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');

    Route::resource('categories', CategoriesController::class);


    /*
    *
    *  Comments Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'comments';
    $controller_name = 'CommentsController';

    Route::get('comments/index_list', [CommentsController::class, 'index_list'])->name('comments.index_list');

    Route::get('comments/index_data', [CommentsController::class, 'index_data'])->name('comments.index_data');

    Route::get('comments/trashed', [CommentsController::class, 'trashed'])->name('comments.trashed');

    Route::patch('comments/trashed/{id}', [CommentsController::class, 'restore'])->name('comments.restore');

    Route::resource('comments', CommentsController::class);


    /*
     *
     *  Tags Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'tags';
    $controller_name = 'TagsController';

    Route::get('tags/index_list', [TagsController::class, 'index_list'])->name('tags.index_list');

    Route::get('tags/index_data', [TagsController::class, 'index_data'])->name('tags.index_data');

    Route::get('tags/trashed', [TagsController::class, 'trashed'])->name('tags.trashed');

    Route::patch('tags/trashed/{id}', [TagsController::class, 'restore'])->name('tags.restore');

    Route::resource('tags', TagsController::class);

    // Exchange Rate App
    Route::get('exchange-rate', \App\Http\Livewire\Conversion::class);

    Route::post('import', [UserController::class, 'import'])->name('users.import'); // import route
    Route::get('export', [UserController::class, 'export'])->name('users.export'); // export route
});


Route::fallback(function () {
    // ...
    dd('404 backend');
});
