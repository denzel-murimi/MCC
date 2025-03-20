<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;
use App\Models\Child;
class AdoptionController extends Controller
{
    /**
     * Show the adoption form.
     */
    public function index()
    {
        $children = Child::all(); // Fetch all children from the database
    return view('adopt', compact('children'));

    }

    public function showForm($childId)
{
    $child = Child::findOrFail($childId);
    return view('form', compact('child'));
}



    /**
     * Handle the adoption form submission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:1',
            'recurring' => 'nullable|boolean',
        ]);

        Adoption::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'recurring' => $request->recurring ?? false,
        ]);

        return redirect()->route('adopt')->with('success', 'Your adoption pledge has been received!');
    }
}
