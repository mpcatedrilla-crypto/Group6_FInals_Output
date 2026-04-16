<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => response('API — use /api/health', 200, ['Content-Type' => 'text/plain; charset=UTF-8']));
