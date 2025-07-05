<?php

use App\Http\Controllers\Api\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{short}', [LinkController::class, 'redirectToOriginal'])
    ->where('short', '[a-zA-Z0-9]+');
