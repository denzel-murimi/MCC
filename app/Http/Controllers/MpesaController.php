<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\PhoneNumberFormatService;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MpesaController extends Controller
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $shortcode;
    protected $passkey;
    protected $callbackUrl;
    protected $env;
    protected $base_url;

    public function __construct()
    {
        $this->consumerKey = config('payments.mpesa.consumer_key');
        $this->consumerSecret = config('payments.mpesa.consumer_secret');
        $this->shortcode = config('payments.mpesa.shortcode');
        $this->passkey = config('payments.mpesa.passkey');
        $this->callbackUrl = config('app.url').config('payments.mpesa.callback_url');
        $this->env = config('payments.mpesa.env');
        $this->base_url = $this->env == 'sandbox' ? 'https://sandbox.safaricom.co.ke/' : 'https://api.safaricom.co.ke/';
    }

    /**
     * Get M-Pesa Access Token
     */
    private function getAccessToken()
    {
        try {
            $url = $this->base_url . 'oauth/v1/generate?grant_type=client_credentials';
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)->get($url);
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

        //Formatted Phone Number
        $p = PhoneNumberFormatService::format($request->phone);

        // Get Access Token
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return redirect()
                ->back()
                ->withInput()
                ->with('activeTab', 'mpesa')
                ->with('error', 'Whoops!! Could not Connect to MPESA! Try again later');
        }

        // Generate Password
        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $url = $this->base_url . 'mpesa/stkpush/v1/processrequest';

        // Prepare Payload
        $payload = [
            "BusinessShortCode" => $this->shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $request->amount,
            "PartyA" => $p,
            "PartyB" => $this->shortcode,
            "PhoneNumber" => $p,
            "CallBackURL" => $this->callbackUrl,
            "AccountReference" => "MCC DONATION",
            "TransactionDesc" => "Donation to Mathare Care Center"
        ];

        try {
            // Send STK Push Request
            $response = Http::withToken($accessToken)->post($url,$payload);

            Log::info("STK Push Response: ",[$response, $payload]);

            //Create new Donation Record
            $res = json_decode($response);

            if ($res->ResponseCode == 0) {
                $donation = new Donation();
                $donation->type = 'MPESA';
                $donation->phone = $p;
                $donation->amount = $request->amount;
                $donation->currency = 'KES';
                $donation->reference = $payload['AccountReference'];
                $donation->description = $payload['TransactionDesc'];
                $donation->MerchantRequestID = $res->MerchantRequestID;
                $donation->CheckoutRequestID = $res->CheckoutRequestID;
                $donation->status = 'Requested';
                $donation->save();
            }

            // Return response
            return redirect()
                ->back()
                ->withInput()
                ->with('activeTab', 'mpesa')
                ->with('success', 'STK Push request sent successfully');

        } catch (\Exception $e) {
            Log::error("STK Push Error: " . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('activeTab', 'mpesa')
                ->with('error', 'Whoops!! Something happened!...Try again later');
        }
    }

    public function stkCallback() :JsonResponse
    {
        $data = file_get_contents('php://input');
        Log::info("STK Callback Response: ", [$data]);

        $res = json_decode($data);

        try {
            if (isset($res->Body->stkCallback->CheckoutRequestID)) {
                if ($res->Body->stkCallback->ResultCode == 0) {
                    $donation = Donation::where('MerchantRequestID', $res->Body->stkCallback->MerchantRequestID)->firstOrFail();
                    $donation->status = 'Completed';
                    $donation->MpesaReceiptNumber = $res->Body->stkCallback->CallbackMetadata->Item[1]->Value;
                    $donation->TransactionDate = $res->Body->stkCallback->CallbackMetadata->Item[2]->Value;
                    $donation->ResultDesc = $res->Body->stkCallback->ResultDesc;
                    $donation->save();

                    $this->notify($donation->phone, 'success', 'Your Donation was successful. Mpesa Receipt: ' . $donation->MpesaReceiptNumber . ' of KES: ' . $donation->amount . ' on ' . Carbon::parse($donation->TransactionDate)->format('H:i:s l Y-m-d'));

                } else {

                    $donation = Donation::where('MerchantRequestID', $res->Body->stkCallback->CheckoutRequestID)->firstOrFail();
                    $donation->status = 'Failed';
                    $donation->ResultDesc = $res->Body->stkCallback->ResultDesc;
                    $donation->save();

                    $this->notify($donation->phone, 'error', 'Your Donation of KES: ' .$donation->amount. '. Failed...Please try again later!' );

                }
                return response()->json(['status' => 'success'],200);
            }
            return response()->json(['status' => 'failed'],200);
        } catch (\Exception $e) {
            Log::error("STK Callback Error: " , [$e->getMessage()]);
            return response()->json(['status' => 'error'],200);
        }

    }

    public function notify($phone, $status, $message)
    {
        Log::info("STK Callback Success Notification: ", [$phone, $status, $message]);
        return true;
    }
}
