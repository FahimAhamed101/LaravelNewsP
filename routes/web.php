<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('user-home');
Route::get('/login', fn () => redirect()->route('user-login'))->name('login');

Route::get('/news/{id}/{slug}', [HomeController::class, 'newsDetais'])->name('news-detail');
Route::get('/category/{id}/{slug}', [HomeController::class, 'categoryNews'])->name('category-news');
Route::get('/subcategory/{id}/{slug}', [HomeController::class, 'subCategoryNews'])->name('sub-category-news');
Route::post('/search/date', [HomeController::class, 'searchByDate'])->name('search-by-date');
Route::post('/search/name', [HomeController::class, 'searchByName'])->name('search-by-name');
Route::get('/admin/news/{id}', [HomeController::class, 'adminNews'])->name('admin-wise-news');
Route::get('/photo-gallery', [HomeController::class, 'allPhotoGallery'])->name('all-photo-gallery');
Route::get('/video-gallery', [HomeController::class, 'allVideoGallery'])->name('all-video-gallery');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [HomeController::class, 'contactUsPost'])->name('contact-us-post');

Route::prefix('user')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('user-register');
    Route::get('/login', [UserController::class, 'login'])->name('user-login');

    Route::post('/register/post', [UserController::class, 'registerPost'])->name('user-register-post');
    Route::post('/login/post', [UserController::class, 'loginPost'])->name('user-login-post');

    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user-dashboard');
        Route::post('/profile/update', [UserController::class, 'userProfileUpdate'])->name('user-profile-update');
        Route::get('/change/password', [UserController::class, 'userChangePassword'])->name('user-change-password');
        Route::post('/change/password/update', [UserController::class, 'userChangePasswordUpdate'])->name('user-change-password-update');
        Route::get('/logout', [UserController::class, 'userLogout'])->name('user-logout');
        Route::post('/review/post', [HomeController::class, 'reviewPost'])->name('review-post');
    });
});
