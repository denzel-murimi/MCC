<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function checkout(Request $request)
    {
        // Add PayPal integration logic here
        return redirect()->away('https://www.paypal.com/checkout');

    }
}
