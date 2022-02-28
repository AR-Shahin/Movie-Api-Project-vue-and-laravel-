<?php

use App\Http\Controllers\Api\{CategoryController, UserController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{slug}', 'show');
    Route::post('update/{slug}', 'update');
    Route::delete('/{slug}', 'delete');
});


Route::prefix('user')->controller(UserController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:user_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});
