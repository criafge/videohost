<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('videos', VideoController::class)->except('index', 'create');

Route::group(['middleware' => 'auth'], function () {
    Route::get('video/{video}/like', [VideoController::class, 'like'])->name('like');
    Route::get('video/{video}/dislike', [VideoController::class, 'dislike'])->name('dislike');
});


// Route::group(['namespace' => 'App\Http\Controllers\user'], function(){
//     Route::post('create-video', 'CreateVideoController')->name('create-video');
// })->middleware('auth');

// Route::group(['namespace' =>' App\Http\Controllers\admin'], function(){
//     Route::get();
// })->middleware('admin');
