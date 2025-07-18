<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/subscribe', [SubscriptionController::class, 'store']);

    Route::controller(PostController::class)->group(function () {
        Route::post('/create-post', 'store');
        Route::get('/posts/{post}', 'show')->name('posts.show');
    });
});
