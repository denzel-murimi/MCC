<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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
