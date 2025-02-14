<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        try {

            Mail::to(env('MAIL_USERNAME'))
                ->queue(new ContactForm(
                    name: $request->name,
                    email: $request->email,
                    content: $request->message
                ));

            return back()->with('success', 'Message sent successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Whoops!! Something happened!...Try again later');
        }
    }
}
