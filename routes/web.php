<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Articles\ArticlesOpinionsController;
use App\Http\Controllers\Web\Articles\ArticlesCommentsController;
use App\Http\Controllers\Web\Articles\ArticlesController;
use App\Http\Controllers\Web\Users\AuthController;
use App\Http\Controllers\Web\Users\UsersController;
use App\Http\Controllers\Web\Users\UsersAvatasController;


//Guest
Route::middleware('guest')->group(function () {

    //Registration
    Route::get('registration', [AuthController::class, 'registration'])->name('registration');

    Route::post('registration', [AuthController::class, 'signup'])->name('signup');

    //Login
    Route::get('login', [AuthController::class, 'login'])->name('login');

    Route::post('login', [AuthController::class, 'signin'])->name('signin');
});

//Auth
Route::middleware('auth')->group(function () {
 
    // Home
    Route::get('home', [AuthController::class, 'index'])->name('home');

    //Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //User
    Route::get('users', [UsersController::class, 'index'])->name('users');

    Route::get('user-articles', [UsersController::class, 'articles'])->name('user-articles');

    Route::put('users-update', [UsersController::class, 'update'])->name('users-update');

    Route::put('users-password-update', [UsersController::class, 'passwordUpdate'])->name('users-password-update');

    //User//Avatar
    Route::get('users-avatar-add', [UsersAvatasController::class, 'add'])->name('users-avatar-add');

    Route::post('users-avatar-create', [UsersAvatasController::class, 'create'])->name('users-avatar-create');

    Route::delete('users-avatar-delete', [UsersAvatasController::class, 'destroy'])->name('users-avatar-destroy');

    //Article 
    Route::get('articles-{id}-view', [ArticlesController::class, 'view'])->name('articles-view');

    Route::get('articles-create', [ArticlesController::class, 'create'])->name('articles-create');

    Route::post('articles-store', [ArticlesController::class, 'store'])->name('articles-store');

    Route::get('articles-{id}-edit', [ArticlesController::class, 'edit'])->name('articles-edit');

    Route::patch('articles-{id}-update', [ArticlesController::class, 'update'])->name('articles-update');

    Route::delete('articles-{id}', [ArticlesController::class, 'destroy'])->name('articles-destroy');

    //Article//Like//Dislike
    Route::post('articles-{id}-like', [ArticlesOpinionsController::class, 'articlesLike'])->name('articles-like');

    Route::post('articles-{id}-dislike', [ArticlesOpinionsController::class, 'articlesDislike'])->name('articles-dislike');

    //Article//Comment
    Route::post('articles-{id}-comments', [ArticlesCommentsController::class, 'store'])->name('articles-comments-store');

    Route::post('articles-{id}-comments-{comment_id}', [ArticlesCommentsController::class, 'reply'])->name('articles-comments-reply');
});
