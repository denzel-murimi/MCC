<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', function(){
    return view('gallery');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact',[ContactController::class, 'submit'])->name('contact.submit');

Route::get('/program', function (){
    return view('program');
});