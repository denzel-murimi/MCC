<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CryptoController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $sign = $request->header('x-nowpayments-sig');
            if (!$sign) {
                Log::debug('sign header not found');
                return to_route('donate')->with('error', 'Error: Crypto Error');
            }

            $raw_body = $request->getContent();

            $paymentData = json_decode($raw_body, true);

            if (!$paymentData) {
                Log::debug('raw body is empty');
                return to_route('donate')->with('error', 'Error: Crypto Error');
            }

            if (!$this->verify_signature($paymentData, $sign)) {
                Log::debug('signature verification failed');
                return to_route('donate')->with('error', 'Error: Crypto Error');
            }

            $this->process_payment($paymentData);

            Log::info("Crypto Donation Completed: ", [$request->all()]);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::debug('Crypto Exception: ', [$e->getMessage(),$e->getTraceAsString()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    private function verify_signature(array $data, string $signature)
    {
        $ipn = config('payments.crypto.ipn_key');

        if (!$ipn) {
            Log::debug('ipn header not found');
            return false;
        }

        $sorted = [];
        $sortedKeys = array_keys($data);
        sort($sortedKeys);
        foreach ($sortedKeys as $key) {
            $sorted[$key] = $data[$key];
        }

        $json = json_encode($sorted, JSON_UNESCAPED_SLASHES);

        $calc = hash_hmac('sha512', $json, $ipn);

        return hash_equals($calc, $signature);
    }

    /**
     * @throws \Exception
     */
    private function process_payment(array $data): void
    {
        DB::beginTransaction();
        try {
            $existing = Donation::where('ReceiptNumber',$data['payment_id'])->first();

            $record = [
                'type' => 'BITCOIN',
                'ReceiptNumber' => $data['payment_id'],
                'status' => strtoupper($data['payment_status']),
                'amount' => $data['actually_paid'],
                'currency' =>  strtoupper($data['pay_currency']),
                'transaction_date' => now(),
                'metadata' => json_encode($data),
            ];

            if ($existing) {
                $existing->update($record);
            } else{
                Donation::create($record);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
