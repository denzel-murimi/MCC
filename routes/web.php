<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\ProgramController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AuthController;

// ----------------------
// Auth Routes
// ----------------------
Route::prefix('signin')
    ->controller(AuthController::class)
    ->group(function () {
    Route::get('/', 'showSigninForm')->name('signin');
    Route::post('/', 'authenticate')->name('signin.authenticate');
});

// ----------------------
// Adoption Routes
// ----------------------
Route::prefix('adopt')
    ->controller(AdoptionController::class)
    ->name('adopt.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/child/{id}', 'showForm')->name('form');
});

// ----------------------
// Donation & Payment Routes
// ----------------------
Route::prefix('mpesa')->group(function () {
    Route::post('/donate', [MpesaController::class, 'stkPush'])->name('mpesa.donate');
});
Route::post('/paypal-complete', [PayPalController::class, 'complete'])->name('paypal.complete');
Route::prefix('paystack')
    ->controller(PaystackController::class)
    ->name('paystack.')
    ->group(function () {
    Route::post('/donate', 'donate')->name('donate');
    Route::get('/callback', 'callback')->name('callback');
});
Route::post('crypto/callback', [\App\Http\Controllers\CryptoController::class, 'callback'])->name('crypto.callback')
    ->withoutMiddleware([VerifyCsrfToken::class]);

// ----------------------
// Volunteer Routes
// ----------------------
Route::prefix('volunteer-signup')
    ->controller(VolunteerController::class)
    ->name('volunteer.')
    ->group(function () {
    Route::get('/', 'showForm')->name('signup');
    Route::post('/', 'store')->name('store');
});

// ----------------------
// Contact & Newsletter Routes
// ----------------------
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('subscribe');
Route::get('/verify-subscription/{token}', [ContactController::class, 'verify'])->name('verify.subscription');

// ----------------------
// Program Routes
// ----------------------
Route::prefix('program')
    ->controller(ProgramController::class)
    ->name('program.')
    ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{program:slug}', 'show')->name('show');
});

// ----------------------
// Static Pages
// ----------------------
Route::view('/', 'home')->name('home');
Route::view('/gallery', 'gallery')->name('gallery');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/donate', 'donation')->name('donate');
Route::view('/faq', 'faq');
Route::view('/terms', 'terms');
Route::view('/privacy-policy', 'privacy');
Route::view('/our-story', 'our-story')->name('our-story');

Route::get('/three', function () {
    return view('errors.500');
});
