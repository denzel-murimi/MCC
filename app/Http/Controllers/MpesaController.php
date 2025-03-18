<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[17]\d{8}$/',
            'amount' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('activeTab', 'mpesa')
                ->withErrors($validator,'mpesaValidation');
        }

        // Get Access Token
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['error' => 'Failed to generate access token'], 500);
        }

        // Generate Password
        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

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
            $response = Http::withToken($accessToken)->post($url,$payload);

            Log::info("STK Push Response: ",[$response, $payload, $accessToken]);

            // Return response
            return response()->json($response);

        } catch (\Exception $e) {
            Log::error("STK Push Error: " . $e->getMessage());
            return response()->json([
                'error' => 'STK Push request failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function stkCallback(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = file_get_contents('php://input');
        Log::info("STK Callback Response: ",[$data]);
        return response()->json($data);
    }
}
