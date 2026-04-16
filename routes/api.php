<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

// Public — no Authorization header
Route::get('/health', static fn () => [
    'status' => 'ok',
    'authentication' => 'http_basic',
]);

/*
|--------------------------------------------------------------------------
| Basic Auth group — Laravel middleware: auth.basic
|--------------------------------------------------------------------------
| The client must send: Authorization: Basic base64("email:password")
| Laravel checks `users.email` and `password` (bcrypt). No token is issued.
*/
Route::middleware('auth.basic')->group(function (): void {
    Route::get('/v1/me', [AuthController::class, 'me']);
    Route::post('/v1/logout', [AuthController::class, 'logout']);

    Route::get('/v1/events', [EventController::class, 'index']);
    Route::get('/v1/events/{event}', [EventController::class, 'show']);
});
