<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\
{FrontPostController, HomeController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use UniSharp\LaravelFilemanager\Lfm;

Route::get('/', [FrontPostController::class, 'index'])->name('home');

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('{slug}', [FrontPostController::class, 'show'])->name('display');
});

Route::get('author/{user}', [FrontPostController::class, 'author'])->name('author');
Route::get('category/{category:slug}', [FrontPostController::class, 'category'])->name('category');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);
