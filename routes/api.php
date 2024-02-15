<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1'], function () {
    //auth
    Route::group(['prefix' => 'auth'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');
        });
    });
    //posts
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'all');
        Route::get('/{post}/view', 'viewPost');
        Route::get('/{post}/comments', 'comments');
        Route::post('/{post}/newComment', 'newComment');
        Route::get('/categories/{category}', 'getByCategory');
        Route::get('/newest', 'newest');
        //search
        Route::get('/search/{value}', 'search');
    });
    //categories
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'all');
    });
    //dashboard
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/user', 'user');
        Route::get('/bookmarks', 'bookMarks');
        Route::post('/{post}/bookmark', 'newBookmarks');
        Route::post('/logout', 'logout');
    });
});
