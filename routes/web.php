<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AuthController;

Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'authenticate'])->name('signin.authenticate');

Route::get('/adopt/child/{id}', [AdoptionController::class, 'showForm'])->name('adopt.form');


Route::get('/adopt', [AdoptionController::class, 'index'])->name('adopt.index');
Route::post('/adopt', [AdoptionController::class, 'store'])->name('adopt.store');

Route::post('/mpesa/donate', [MpesaController::class, 'stkPush'])->name('mpesa.donate');

Route::post('/paypal-complete', [PayPalController::class, 'complete'])->name('paypal.complete');

Route::post('/paystack/donate', [\App\Http\Controllers\PaystackController::class, 'donate'])->name('paystack.donate');

Route::get('/paystack/callback', [\App\Http\Controllers\PaystackController::class, 'callback'])->name('paystack.callback');


Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', function(){
    return view('gallery');
})->name('gallery');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::post('/contact',[ContactController::class, 'submit'])->name('contact.submit');

Route::get('/program', [ProgramController::class, 'index'])->name('programs');

Route::get('/program/{program:slug}', [ProgramController::class, 'show'])->name('program.show');

Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('subscribe');

Route::get('/verify-subscription/{token}', [ContactController::class, 'verify'])->name('verify.subscription');


Route::get('/donate', function () {
    return view('donation');
})->name('donate');

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/our-story', function () {
    return view('our-story');
})->name('our-story');
Route::get('/volunteer-signup', [VolunteerController::class, 'showForm'])->name('volunteer.signup');
Route::post('/volunteer-signup', [VolunteerController::class, 'store'])->name('volunteer.store');
