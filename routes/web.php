<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/photo/delete-user-profile/{id}', [PhotoController::class, 'deleteuser'])->name('delete-photo-user');

    Route::resource('setting/user', UserController::class);

    //Data
    Route::get('/setting/user-data', [DataController::class, 'user'])->name('user.data');
});

require __DIR__.'/auth.php';
