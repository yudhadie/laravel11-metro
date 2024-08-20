<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Route::middleware('auth')->prefix('dashboard')->group(function () {

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

});

require __DIR__.'/auth.php';
