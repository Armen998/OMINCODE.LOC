<?php

use App\Http\Controllers\Admin\Articles\ArticlesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Users\UsersController;


// Admin

Route::middleware('guest:admin')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');

    Route::post('login', [AuthController::class, 'signin'])->name('signin');
});

Route::middleware('auth:admin')->group(function () {

    //Home
    Route::get('home', [AuthController::class, 'index'])->name('home');

    //Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //Admin Profile
    Route::get('profile', [AuthController::class, 'adminProfile'])->name('admin-profile');

    Route::put('data-update', [AuthController::class, 'adminDataUpdate'])->name('data-update');

    Route::put('password-update', [AuthController::class, 'adminPasswordUpdate'])->name('password-update');

    //Admin Avatar
    Route::get('avatar-add', [AuthController::class, 'avatarAdd'])->name('avatar-add');

    Route::post('avatar-create', [AuthController::class, 'avatarCreate'])->name('avatar-create');

    Route::get('avatar-delete', [AuthController::class, 'avatarDestroy'])->name('avatar-destroy');

    //Article
    Route::get('articles', [ArticlesController::class, 'index'])->name('articles');

    Route::put('articles-{id}-block', [ArticlesController::class, 'articleBlock'])->name('articles-block');

    Route::put('articles-{id}-unlock', [ArticlesController::class, 'articleUnlock'])->name('articles-unlock');

    Route::put('articles-{id}-favorite', [ArticlesController::class, 'articleFavorite'])->name('articles-favorite');
    
    Route::delete('articles-{id}-unfavorite', [ArticlesController::class, 'articleUnfavorite'])->name('articles-unfavorite');

    Route::delete('articles-{id}', [ArticlesController::class, 'articleDestroy'])->name('articles-destroy');

    //User
    Route::get('users', [UsersController::class, 'users'])->name('users');

    Route::get('users-add', [UsersController::class, 'userAdd'])->name('user-add');

    Route::post('registration', [UsersController::class, 'signup'])->name('signup');

    Route::put('makeAdmin/{id}', [UsersController::class, 'makeAdmin'])->name('make-admin');

    Route::put('makeAegular-{id}', [UsersController::class, 'makeRegular'])->name('make-regular');

    Route::delete('users-{id}', [UsersController::class, 'userDestroy'])->name('urers-destroy');

    Route::get('users-{id}-data-change', [UsersController::class, 'usersDataChange'])->name('users-data-change');

    Route::get('users-{id}-home', [UsersController::class, 'usersHome'])->name('users-home');

});