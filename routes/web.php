<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', function(){
    return view('gallery');
});