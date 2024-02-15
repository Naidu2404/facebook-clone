<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
    ->group(function () {

        Route::apiResource('/posts', App\Http\Controllers\PostController::class);
        Route::apiResource('/users', App\Http\Controllers\UserController::class);
        Route::apiResource('/users/{user}/posts', App\Http\Controllers\UserPostController::class);

    });