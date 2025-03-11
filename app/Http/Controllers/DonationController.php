<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DonationController extends Controller
{
    public function stkPush(Request $request)
    {
        $phone = $request->phone; // User's phone number
        $amount = $request->amount; // Donation amount

        $timestamp = now()->format('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        // Get Access Token
        $response = Http::withBasicAuth(env('MPESA_CONSUMER_KEY'), env('MPESA_CONSUMER_SECRET'))
            ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        $accessToken = $response->json()['access_token'];

        // Send STK Push
        $stkResponse = Http::withToken($accessToken)
            ->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                "BusinessShortCode" => env('MPESA_SHORTCODE'),
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $amount,
                "PartyA" => $phone,
                "PartyB" => env('MPESA_SHORTCODE'),
                "PhoneNumber" => $phone,
                "CallBackURL" => env('MPESA_CALLBACK_URL'),
                "AccountReference" => "MCC Donations",
                "TransactionDesc" => "Support Mathare Care Center"
            ]);

        return response()->json($stkResponse->json());
    }
    public function createPaypalPayment(Request $request)
{
    $client = new \GuzzleHttp\Client();
    $auth = base64_encode(env('PAYPAL_CLIENT_ID') . ":" . env('PAYPAL_SECRET'));

    $response = $client->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
        'headers' => [
            'Authorization' => "Basic $auth",
            'Content-Type' => 'application/json'
        ],
        'json' => [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]
    ]);

    return response()->json(json_decode($response->getBody()));
}

}
