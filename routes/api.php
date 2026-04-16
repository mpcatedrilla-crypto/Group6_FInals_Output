<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/health', static fn () => [
    'status' => 'ok',
    'service' => 'Group 6 Event Management API',
    'authentication' => 'http_basic',
]);

Route::middleware('auth.basic')->group(function (): void {
    Route::get('/v1/me', [AuthController::class, 'me']);
    Route::post('/v1/logout', [AuthController::class, 'logout']);

    Route::get('/v1/events', [EventController::class, 'index']);
    Route::get('/v1/events/{event}', [EventController::class, 'show']);
    Route::post('/v1/events', [EventController::class, 'store']);
});
