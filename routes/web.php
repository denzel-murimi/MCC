<?php

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

Route::post('/contact', function (Request $request) {
    // Validate input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // Send email (optional - configure mail settings in .env)
    Mail::raw("Message from: {$request->name}\n\n{$request->message}", function ($mail) use ($request) {
        $mail->to('denzelerrands@gmail.com')->subject('New Contact Message');
        $mail->from($request->email, $request->name);
    });

    return redirect()->route('contact')->with('success', 'Message sent successfully!');
})->name('contact.submit');