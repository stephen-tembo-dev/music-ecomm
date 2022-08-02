<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MusicController;
use App\Http\Controllers\CommentController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/music-upload', [MusicController::class, 'store']);
Route::get('/music', [MusicController::class, 'index']);
Route::get('/music/{id}', [MusicController::class, 'show']);
Route::delete('/music/{id}', [MusicController::class, 'destroy']);

Route::post('/comment', [CommentController::class, 'store']);
