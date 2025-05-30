<?php

use Illuminate\Support\Facades\Route;

Route::get('/mpesa/callback', [\App\Http\Controllers\MpesaController::class, 'stkCallback'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/events', [\App\Http\Controllers\ProgramController::class, 'eventsAPI']);
