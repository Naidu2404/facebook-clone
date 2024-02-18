<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->group(function () {

        Route::get('/auth-user', [App\Http\Controllers\AuthUserController::class, 'show']);

        Route::apiResource('/posts', App\Http\Controllers\PostController::class);
        Route::apiResource('/users', App\Http\Controllers\UserController::class);
        Route::apiResource('/users/{user}/posts', App\Http\Controllers\UserPostController::class);
        Route::apiResource('/friend-request', App\Http\Controllers\FriendRequestController::class);
        Route::apiResource('/friend-request-response', App\Http\Controllers\FriendRequestResponseController::class);

    });