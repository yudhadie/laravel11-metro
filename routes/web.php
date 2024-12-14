<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\information\LogActivityController;
use App\Http\Controllers\Admin\Setting\PhotoController;
use App\Http\Controllers\Admin\Test\TestContentController;
use App\Http\Controllers\Admin\Test\TestImageController;
use App\Http\Controllers\Admin\Test\TestModalController;
use App\Http\Controllers\Admin\Test\TestStandartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/test', [WebsiteController::class, 'test'])->name('test');
Route::get('api/test', [WebsiteController::class, 'api_test'])->name('api.test');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [WebsiteController::class, 'profile'])->name('web.profile');

});

Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin']], function() {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/photo/delete-user-profile/{id}', [PhotoController::class, 'deleteuser'])->name('delete-photo-user');

    //Setting
    Route::resource('setting/user', UserController::class);
    //Information
    Route::resource('information/log-activity', LogActivityController::class);

    //Data
    Route::get('/setting/user-data', [DataController::class, 'user'])->name('user.data');
    Route::get('information/log-activity-data', [DataController::class, 'activity'])->name('data.activity');

    //Test
    Route::resource('/test-standart', TestStandartController::class);
    Route::resource('/test-modal', TestModalController::class);
    Route::resource('/test-image', TestImageController::class);
    Route::resource('/test-content', TestContentController::class);
    Route::get('/test-data', [DataController::class, 'test'])->name('test.data');

});

require __DIR__.'/auth.php';
