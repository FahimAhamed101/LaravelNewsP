<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('user-home');

Route::group(['prefix' => 'user'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('user-register');
    Route::get('/login', [UserController::class, 'login'])->name('user-login');

    Route::post('/register/post', [UserController::class, 'registerPost'])->name('user-register-post');
    Route::post('/login/post', [UserController::class, 'loginPost'])->name('user-login-post');

    Route::post('/review/post', [HomeController::class, 'reviewPost'])->name('review-post');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user-dashboard');
        Route::post('/profile/update', [UserController::class, 'userProfileUpdate'])->name('user-profile-update');
        Route::get('/change/password', [UserController::class, 'userChangePassword'])->name('user-change-password');
        Route::post('/change/password/update', [UserController::class, 'userChangePasswordUpdate'])->name('user-change-password-update');
        Route::get('/logout', [UserController::class, 'userLogout'])->name('user-logout');
    });
});