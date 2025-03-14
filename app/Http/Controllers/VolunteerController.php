<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    // Display the form
    public function showForm()
    {
        return view('volunteer');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'phone' => 'required|string|max:20',
            'availability' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Save to database 
        Volunteer::create($request->all());

        // Optional: Send a confirmation email
        Mail::raw("Thank you for signing up as a volunteer!", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Volunteer Sign-Up Confirmation');
        });

        // Redirect back with success message
        return redirect()->route('volunteer.signup')->with('success', 'Thank you for signing up!');
    }
}
