<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use GPBMetadata\Google\Api\Log;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function complete(Request $request)
    {
        try {
            \Illuminate\Support\Facades\Log::info("Paypal Donation Completed: ", $request->all());

            $donation = new Donation();
            $donation->type = 'PAYPAL';
            $donation->amount = $request->amt;
            $donation->currency = $request->cc;
            $donation->reference = "MCC PayPal Donation";
            $donation->status = $request->st;
            $donation->ReceiptNumber = $request->tx;
            $donation->save();

            return redirect()->back()->with('success', 'PayPal Donation Completed');
        } catch (\Exception $e){
            \Illuminate\Support\Facades\Log::error("Paypal Donation Failed", [$e->getMessage()]);
            return redirect()->back()->with('error', 'PayPal Donation Failed. Try again later!');
        }
    }
}
