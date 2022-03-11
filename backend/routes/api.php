<?php

use App\Http\Controllers\Api\{
    CategoryController,
    FavouriteController,
    MovieController,
    UserController
};
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{slug}', 'show');
    Route::post('update/{slug}', 'update');
    Route::delete('/{slug}', 'delete');
});
Route::get('cat-movies', [CategoryController::class, 'categoryMovies']);
Route::controller(MovieController::class)->prefix('movies')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{slug}', 'show');
    Route::post('update/{slug}', 'update');
    Route::delete('/{slug}', 'delete');
});

Route::prefix('user')->controller(UserController::class)->group(function () {

    # Auth
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:user_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });

    Route::controller(FavouriteController::class)->middleware('auth:user_api')->group(function () {
        Route::post('favourite', 'addToFavourite');
        Route::get('favourite', 'userFavMovies');
        Route::delete('favourite/{id}', 'deleteMovie');
    });
});


Route::controller(Review::class)->prefix('reviews')->group(function () {
    Route::get('/', 'reviews');
    Route::post('/', 'addReview');
});
