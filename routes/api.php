<?php

use Illuminate\Support\Facades\Route;

Route::post('/mpesa/callback', [\App\Http\Controllers\MpesaController::class, 'stkCallback'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/events', [\App\Http\Controllers\ProgramController::class, 'eventsAPI']);
