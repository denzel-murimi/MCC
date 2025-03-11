<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    private $consumerKey;
    private $consumerSecret;
    private $shortcode;
    private $passkey;
    private $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->shortcode = env('MPESA_SHORTCODE');
        $this->passkey = env('MPESA_PASSKEY');
        $this->callbackUrl = env('MPESA_CALLBACK_URL');
    }

    /**
     * Get M-Pesa Access Token
     */
    private function getAccessToken()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', [
                'auth' => [$this->consumerKey, $this->consumerSecret]
            ]);

            $body = json_decode($response->getBody());
            return $body->access_token ?? null;
        } catch (\Exception $e) {
            Log::error("M-Pesa Access Token Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Initiate STK Push Request
     */
    public function stkPush(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'phone' => 'required|regex:/^2547\d{8}$/',
            'amount' => 'required|numeric|min:1'
        ]);

        // Get Access Token
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['error' => 'Failed to generate access token'], 500);
        }

        // Generate Password
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        // Prepare Payload
        $payload = [
            "BusinessShortCode" => $this->shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $request->amount,
            "PartyA" => $request->phone,
            "PartyB" => $this->shortcode,
            "PhoneNumber" => $request->phone,
            "CallBackURL" => $this->callbackUrl,
            "AccountReference" => "MCC DONATION",
            "TransactionDesc" => "Donation to Mathare Care Center"
        ];

        try {
            // Send STK Push Request
            $client = new Client();
            $response = $client->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json'
                ],
                'json' => $payload
            ]);

            // Decode response
            $mpesaResponse = json_decode($response->getBody(), true);
            Log::info("STK Push Response: " . json_encode($mpesaResponse));

            // Return response
            return response()->json($mpesaResponse);

        } catch (\Exception $e) {
            Log::error("STK Push Error: " . $e->getMessage());
            return response()->json([
                'error' => 'STK Push request failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
