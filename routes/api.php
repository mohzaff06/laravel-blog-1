<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\UserController;

// Basic test route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/category/all', [PostController::class, 'index']);
Route::get('/category/{category}', [PostController::class, 'getPostsByCategory']);


