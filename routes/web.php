<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\information\LogActivityController;
use App\Http\Controllers\Admin\Test\TestContentController;
use App\Http\Controllers\Admin\Test\TestImageController;
use App\Http\Controllers\Admin\Test\TestModalController;
use App\Http\Controllers\Admin\Test\TestStandartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SocialliteController;
use App\Http\Controllers\Web\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/test', [WebsiteController::class, 'test'])->name('test');
Route::get('api/test', [WebsiteController::class, 'api_test'])->name('api.test');

//Socialite
Route::get('/auth/redirect/google', [SocialliteController::class, 'google_redirect'])->name('google_redirect');
Route::get('/auth/callback/google', [SocialliteController::class, 'google_callback'])->name('google_callback');
Route::get('/auth/redirect/facebook', [SocialliteController::class, 'facebook_redirect'])->name('facebook_redirect');
Route::get('/auth/callback/facebook', [SocialliteController::class, 'facebook_callback'])->name('facebook_callback');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [WebsiteController::class, 'profile'])->name('web.profile');

});

Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin']], function() {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    //Setting
        //User
        Route::resource('setting/user', UserController::class);
        Route::get('/setting/user-data', [UserController::class, 'data'])->name('user.data');
        Route::put('/photo/delete-user-profile/{id}', [UserController::class, 'deletephoto'])->name('delete-photo-user');
    //Information
    Route::resource('information/log-activity', LogActivityController::class);
    Route::get('information/log-activity-data', [LogActivityController::class, 'data'])->name('activity.data');
    //Test
    Route::resource('/test-content', TestContentController::class);
    Route::resource('/test-image', TestImageController::class);
    Route::resource('/test-modal', TestModalController::class);
    Route::resource('/test-standart', TestStandartController::class);
    Route::get('/test-data', [TestStandartController::class, 'data'])->name('test.data');

});

require __DIR__.'/auth.php';
