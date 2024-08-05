<?php

use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', [CategoryController::class, 'showAllCategories']);
Route::get('/categories/tvshows', [CategoryController::class, 'showTVShowCategories']);
Route::get('/categories/movies', [CategoryController::class, 'showMovieCategories']);
Route::get('/category/{categoryId}/{title?}', [CategoryController::class, 'showCategory'])->name('category.show');

Route::get('watch/{id}', [VideoController::class, 'show'])->name('video.show');

