<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::redirect('/', '/login');
//
Route::get('register', Register::class)->name('admin.register');

Route::get('login', Login::class)->name('admin.login');

Route::get('login-admin', Login::class)->name('admin.loginAdmin');

Route::get('forgot-password', ForgotPassword::class)->name('admin.forgot-password');

Route::get('reset-password/{id}', ResetPassword::class)->name('admin.reset-password')->middleware('signed');

Route::get('404', Err404::class)->name('admin.404');
Route::get('500', Err500::class)->name('admin.500');
Route::get('upgrade-to-pro', UpgradeToPro::class)->name('admin.upgrade-to-pro');

//Update db
/*Route::get('update-db', function () {
    //Drop table tasks from database
    \Illuminate\Support\Facades\Schema::dropIfExists('tasks');
    \Illuminate\Support\Facades\Schema::dropIfExists('user_task_status');
    \Illuminate\Support\Facades\Schema::dropIfExists('user_rewards');
    \Illuminate\Support\Facades\Schema::dropIfExists('user_task_activity');


    return 'Update db success!';
});*/

Route::middleware('auth')->group(function () {
    //Route::get('profile', Profile::class)->name('profile');
    Route::get('profile-example', ProfileExample::class)->name('profile-example');

    //Route::get('users', Users::class)->name('users');

    Route::get('login-example', LoginExample::class)->name('login-example');
    Route::get('register-example', RegisterExample::class)->name('register-example');
    Route::get('forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('reset-password-example', ResetPasswordExample::class)->name('reset-password-example');

    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('transactions', Transactions::class)->name('transactions');
    Route::get('bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('lock', Lock::class)->name('lock');
    Route::get('buttons', Buttons::class)->name('buttons');
    Route::get('notifications', Notifications::class)->name('notifications');
    Route::get('forms', Forms::class)->name('forms');
    Route::get('modals', Modals::class)->name('modals');
    Route::get('typography', Typography::class)->name('typography');

    /*New Component*/

    //22/03/2023 New Router
    //new-user
    //Route::get('new-user', \App\Http\Livewire\NewUser::class)->name('new-user');
    //users resource
    //Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    //role-management
    //Route::get('role-management', \App\Http\Livewire\RoleManagement::class)->name('role-management');
    //category-management
    //Route::get('category-management', \App\Http\Livewire\CategoryManagement::class)->name('category-management');
    //new-category
    //Route::get('new-category', \App\Http\Livewire\NewCategory::class)->name('new-category');
    //tag-management
    //Route::get('tag-management', \App\Http\Livewire\TagManagement::class)->name('tag-management');
    //new-tag
    //Route::get('new-tag', \App\Http\Livewire\NewTag::class)->name('new-tag');
    //item-management
    Route::get('item-management', \App\Http\Livewire\ItemManagement::class)->name('item-management');
    //new-item
    Route::get('new-item', \App\Http\Livewire\NewItem::class)->name('new-item');

    //map
    Route::get('map', \App\Http\Livewire\Map::class)->name('map');

    //kanban
    Route::get('kanban', \App\Http\Livewire\Kanban::class)->name('kanban');

    //messages
    Route::get('messages', \App\Http\Livewire\Messages::class)->name('messages');

    //tasks
    Route::get('tasks', \App\Http\Livewire\Tasks::class)->name('tasks');
    //calendar
    Route::get('calendar', \App\Http\Livewire\Calendar::class)->name('calendar');

    //pricing
    Route::get('pricing', \App\Http\Livewire\Pricing::class)->name('pricing');
    //Widgets
    Route::get('widgets', \App\Http\Livewire\Widgets::class)->name('widgets');

    //invoice example
    Route::get('invoice-example', \App\Http\Livewire\Invoice::class)->name('invoice');

    //traffic-sources
    Route::get('traffic-sources', \App\Http\Livewire\TrafficSources::class)->name('traffic-sources');

    //app-analysis
    Route::get('app-analysis', \App\Http\Livewire\AppAnalysis::class)->name('app-analysis');

    //Todo include backend
    require __DIR__.'/backend.php';
});

//PHPMyInfo
Route::get('phpinfo', function () {
    return phpinfo();
});

//Get Laravel Version
Route::get('laravel-version', function () {
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});

/*Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});*/
