<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\VideoCommentController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('videos', VideoController::class)->except('index', 'create');

    Route::group(['middleware' => 'client'], function () {
        Route::get('video/{video}/{whichGrade}', [VideoController::class, 'changeGrade'])->name('change-grade');
        Route::resource('videos.comments', VideoCommentController::class)->only('store', 'destroy');
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::get('/', App\Http\Controllers\admin\IndexController::class)->name('admin');
        Route::get('change/status/{video}/{item}', [LimitController::class, 'changeStatus'])->name('change-status');
    });
});




