<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackController extends Controller
{
    public function donate(Request $request){
        $donation = null;
        try {
            $validator = Validator::make($request->all(), [
                'amount' => 'required|numeric|min:1',
                'email' => 'required|email',
                'donor_name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:15',
                'message' => 'nullable|string|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('activeTab', 'paystack')
                    ->withErrors($validator,'paystackValidation');
            }

            $paymentData = [
                'amount' => $request->amount * 100,
                'email' => $request->email,
                'currency' => 'KES',
                'reference' => 'DON_'.time().'_'.uniqid(),
                'callback_url' => route('paystack.callback'),
                'metadata' => [
                    'donor_name' => $request->donor_name,
                    'phone' => $request->phone,
                    'message' => $request->message
                ],
            ];
            session(['paystack_reference' => $paymentData['reference']]);

            $donation = new \App\Models\Donation();
            $donation->type = 'PAYSTACK';
            $donation->phone = $request->phone;
            $donation->amount = $request->amount;
            $donation->metadata = $paymentData['metadata'];
            $donation->currency = 'KES';
            $donation->reference = $paymentData['reference'];
            $donation->status = 'Requested';
            $donation->save();


            return (new \Unicodeveloper\Paystack\Paystack)->getAuthorizationUrl($paymentData)->redirectNow();
        } catch (\Exception $exception){
            Log::error('Paystack Donation Error: ', [$exception->getMessage()]);
            if ($donation){
                $donation->status = 'Failed';
                $donation->save();
            }
            return redirect()
                ->back()
                ->withInput()
                ->with('activeTab', 'paystack')
                ->with('error', 'An error occurred while initializing your payment. Please try again.');
        }
    }

    public function callback(Request $request){
        try{
            $details = (new \Unicodeveloper\Paystack\Paystack)->getPaymentData();

            if($details['data']['status'] === 'success'){
                $data = $details['data'];
                $session_ref = session('paystack_reference');
                if ($session_ref !== $data['reference']){
                    return redirect()->route('donate')->with('error', 'Donation Verification Failed. Please try again.');
                }
                $donation = \App\Models\Donation::where('reference', $data['reference'])->first();
                $donation->status = 'Completed';
                $donation->save();
                session()->forget('paystack_reference');
                return redirect()->route('donate')->with('success', 'Your donation has been received! Thank you for your support.');

            } else{
                return redirect()
                    ->route('donate')
                    ->with('activeTab', 'paystack')
                    ->with('error', 'Donation Failed. Please try again.');
            }
        }catch (\Exception $exception){
            Log::error('Paystack Donation Callback Error: ', [$exception->getMessage()]);
            return redirect()
                ->route('donate')
                ->with('activeTab', 'paystack')
                ->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }
}
