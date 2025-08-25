<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'home']);


Route::get('/post/{post}', [PostController::class, 'show']);
Route::get('/post/{post}/edit', [PostController::class, 'edit'])
    ->middleware('auth')
    ->can('update', 'post');
Route::put('/post/{post}', [PostController::class, 'update'])
    ->middleware('auth')
    ->can('update', 'post');
Route::delete('/post/{post}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->can('delete', 'post');



Route::post('/api/post/{post}/create', [CommentController::class, 'store'])
    ->middleware('auth');

Route::delete('/api/comment/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.delete')
    ->can('delete', 'comment');

Route::put('/api/comment/{comment}', [CommentController::class, 'update'])
    ->middleware('auth')
    ->name('comments.update')
    ->can('update', 'comment');

Route::post('/api/post/search', [PostController::class, 'search'])->name('search');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredController::class, 'index'])->name('register');
    Route::post('/register', [RegisteredController::class, 'store']);

    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::get('/create', [PostController::class, 'create']);
    Route::post('/create', [PostController::class, 'store']);
    Route::delete('/logout', [SessionController::class, 'destroy']);
});



Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
    ->middleware(['auth', 'throttle:2,1'])
    ->name('verification.send');



Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');
