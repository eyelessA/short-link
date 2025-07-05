<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/links', [LinkController::class, 'store']);
    Route::get('/links', [LinkController::class, 'index']);
    Route::delete('/links/{id}', [LinkController::class, 'destroy']);
    Route::get('/links/{id}', [LinkController::class, 'show']);
});
