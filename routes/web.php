<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoCommentController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function () {
    Route::resource('videos', VideoController::class)->except('index', 'create');
    Route::resource('videos.comments', VideoCommentController::class)->only('store', 'destroy');

    Route::get('video/{video}/like', [VideoController::class, 'like'])->name('like');
    Route::get('video/{video}/dislike', [VideoController::class, 'dislike'])->name('dislike');
});
