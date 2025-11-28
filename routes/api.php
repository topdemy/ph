<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AuthController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('contacts', ContactController::class);
    Route::delete('contacts', [ContactController::class, 'bulkDelete']);
    Route::put('contacts', [ContactController::class, 'bulkUpdate']);
});

Broadcast::routes([
    'middleware' => ['auth:sanctum']
]);
