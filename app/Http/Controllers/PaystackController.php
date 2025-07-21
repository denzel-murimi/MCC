<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\AdoptionTransaction;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
                'reference' => 'DONATE_'.time().'_'.uniqid(),
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

            Log::info('Callback', [$details]);

            if($details['data']['status'] === 'success'){
                $data = $details['data'];
                $metadata = $data['metadata'] ?? [];
                $reference = $data['reference'];

                // Check if this is an adoption payment
                if ((isset($metadata['purpose']) && $metadata['purpose'] === 'adoption') || str_starts_with($reference, 'ADOPT_')) {
                    // Handle adoption payment
                    return $this->handleAdoptionCallback($data);
                }


                return $this->handleDonationCallback($data);
            } else{
                return $this->handleFailedPayment($details['data']);
            }
        }catch (\Exception $exception){
            Log::error('Paystack Donation Callback Error: ', [$exception->getMessage()]);
            return redirect()
                ->route('donate')
                ->with('activeTab', 'paystack')
                ->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }

    private function handleAdoptionCallback($data)
    {
        $reference = $data['reference'];
        $adoption = Adoption::where('reference', $reference)->first();

        if (!$adoption) {
            Log::error('Adoption not found for reference: ' . $reference);
            return redirect()->route('adopt.index')
                ->with('error', 'Adoption record not found.');
        }

        // Update or create transaction
        $transaction = AdoptionTransaction::where('reference', $reference)->first();
        if (!$transaction) {
            $transaction = new AdoptionTransaction();
            $transaction->adoption_id = $adoption->id;
            $transaction->reference = $reference;
            $transaction->type = $adoption->isRecurring() ?
                AdoptionTransaction::TYPE_INITIAL :
                AdoptionTransaction::TYPE_ONE_TIME;
        }

        // Update transaction with payment data
        $this->updateTransactionFromPaystackData($transaction, $data);

        // Update adoption record
        $this->updateAdoptionFromPaystackData($adoption, $data);

        session()->forget('paystack_reference_adoption');

        return redirect()->route('adopt.index')
            ->with('success', 'Your adoption payment has been received! Thank you for your support.');
    }

    private function handleDonationCallback($data)
    {
        $reference = $data['reference'];
        $session_ref = session('paystack_reference');

        if ($session_ref !== $reference) {
            return redirect()->route('donate')
                ->with('error', 'Donation verification failed. Please try again.');
        }

        $donation = Donation::where('reference', $reference)->first();
        if ($donation) {
            $donation->type = 'PAYSTACK:' . ($data['authorization']['bank'] ?? 'unknown');
            $donation->phone = $data['authorization']['mobile_money_number'] ?? $donation->phone;
            $donation->status = 'Completed';
            $donation->save();
        }

        session()->forget('paystack_reference');
        return redirect()->route('donate')
            ->with('success', 'Your donation has been received! Thank you for your support.');
    }

    private function handleFailedPayment($data)
    {
        $reference = $data['reference'];

        // Check if it's an adoption payment
        if (str_starts_with($reference, 'ADOPT_')) {
            $adoption = Adoption::where('reference', $reference)->first();
            if ($adoption) {
                $adoption->status = Adoption::STATUS_FAILED;
                $adoption->save();

                $transaction = AdoptionTransaction::where('reference', $reference)->first();
                if ($transaction) {
                    $transaction->status = AdoptionTransaction::STATUS_FAILED;
                    $transaction->gateway_message = $data['gateway_response'] ?? 'Payment failed';
                    $transaction->save();
                }
            }
            return redirect()->route('adopt.index')
                ->with('error', 'Adoption payment failed. Please try again.');
        }

        // Handle donation failure
        return redirect()->route('donate')
            ->with('activeTab', 'paystack')
            ->with('error', 'Payment failed. Please try again.');
    }
    private function updateTransactionFromPaystackData(AdoptionTransaction $transaction, $data)
    {
        $transaction->fill([
            'amount' => $data['amount'] / 100,
            'currency' => $data['currency'],
            'status' => AdoptionTransaction::STATUS_SUCCESS,
            'gateway_response' => $data['gateway_response'] ?? null,
            'paid_at' => now(),
            'fees' => ($data['fees'] ?? 0) / 100,
            'channel' => $data['channel'] ?? null,
            'ip_address' => $data['ip_address'] ?? null,
            'authorization_code' => $data['authorization']['authorization_code'] ?? null,
            'transaction_id' => $data['id'] ?? null,
            'gateway_message' => $data['message'] ?? null,
        ]);

        $transaction->save();
    }

    private function updateAdoptionFromPaystackData(Adoption $adoption, $data)
    {
        $adoption->status = Adoption::STATUS_COMPLETED;
        $adoption->authorization_code = $data['authorization']['authorization_code'] ?? null;
        $adoption->total_payments_made = $adoption->total_payments_made + 1;
        $adoption->total_amount_paid = $adoption->total_amount_paid + ($data['amount'] / 100);

        // For recurring payments, store subscription details
        if ($adoption->isRecurring() && isset($data['plan'])) {
            $adoption->status = Adoption::STATUS_ACTIVE;
            $adoption->subscription_code = $data['plan']['subscription_code'] ?? null;
            $adoption->next_payment_date = $data['plan']['next_payment_date'] ?? null;
        }

        $adoption->save();
    }

    /**
     * Handle webhooks from Paystack for subscription events
     */
    public function webhook(Request $request)
    {
        $signature = $request->header('x-paystack-signature');
        $body = $request->getContent();

        if (!$this->verifyWebhookSignature($signature, $body)) {
            Log::error('Invalid webhook signature');
            return response('Unauthorized', 401);
        }

        $event = json_decode($body, true);
        Log::info('Paystack Webhook Event', [$event]);

        switch ($event['event']) {
            case 'subscription.create':
                $this->handleSubscriptionCreate($event['data']);
                break;
            case 'invoice.create':
                $this->handleInvoiceCreate($event['data']);
                break;
            case 'charge.success':
                $this->handleChargeSuccess($event['data']);
                break;
            case 'invoice.payment_failed':
                $this->handlePaymentFailed($event['data']);
                break;
            case 'subscription.disable':
                $this->handleSubscriptionDisabled($event['data']);
                break;
            case 'subscription.not_renew':
                $this->handleSubscriptionNotRenew($event['data']);
                break;
        }

        return response('OK', 200);
    }

    private function verifyWebhookSignature($signature, $body)
    {
        $secret = config('paystack.secretKey');
        $expected = hash_hmac('sha512', $body, $secret);
        return hash_equals($signature, $expected);
    }

    private function handleSubscriptionCreate($data)
    {
        $subscriptionCode = $data['subscription_code'];
        $customerEmail = $data['customer']['email'];

        // Find adoption by email and plan
        $adoption = Adoption::where('email', $customerEmail)
            ->where('plan_code', $data['plan']['plan_code'])
            ->where('contribution_type', Adoption::TYPE_RECURRING)
            ->first();

        if ($adoption) {
            $adoption->subscription_code = $subscriptionCode;
            $adoption->next_payment_date = $data['next_payment_date'];
            $adoption->save();
        }
    }

    private function handleInvoiceCreate($data)
    {
        // Invoice created - payment attempt will be made
        $subscriptionCode = $data['subscription']['subscription_code'];
        $adoption = Adoption::where('subscription_code', $subscriptionCode)->first();

        if ($adoption) {
            Log::info("Invoice created for adoption {$adoption->id}");
        }
    }

    private function handleChargeSuccess($data)
    {
        // Handle successful recurring payment
        if (isset($data['plan'])) {
            $this->handleRecurringPaymentSuccess($data);
        }
    }

    private function handleRecurringPaymentSuccess($data)
    {
        $subscriptionCode = $data['plan']['subscription_code'] ?? null;

        if (!$subscriptionCode) {
            return;
        }

        $adoption = Adoption::where('subscription_code', $subscriptionCode)->first();

        if (!$adoption) {
            Log::error("Adoption not found for subscription: {$subscriptionCode}");
            return;
        }

        // Create transaction record for recurring payment
        $transaction = AdoptionTransaction::create([
            'adoption_id' => $adoption->id,
            'reference' => $data['reference'],
            'amount' => $data['amount'] / 100,
            'currency' => $data['currency'],
            'type' => AdoptionTransaction::TYPE_SUBSCRIPTION,
            'status' => AdoptionTransaction::STATUS_SUCCESS,
            'gateway_response' => $data['gateway_response'] ?? null,
            'paid_at' => now(),
            'fees' => ($data['fees'] ?? 0) / 100,
            'channel' => $data['channel'] ?? null,
            'subscription_code' => $subscriptionCode,
            'authorization_code' => $data['authorization']['authorization_code'] ?? null,
            'transaction_id' => $data['id'] ?? null,
            'gateway_message' => $data['message'] ?? null,
        ]);

        // Update adoption totals
        $adoption->total_payments_made = $adoption->total_payments_made + 1;
        $adoption->total_amount_paid = $adoption->total_amount_paid + ($data['amount'] / 100);
        $adoption->next_payment_date = $data['plan']['next_payment_date'] ?? null;
        $adoption->save();

        Log::info("Recurring payment processed for adoption {$adoption->id}");
    }

    private function handlePaymentFailed($data)
    {
        $subscriptionCode = $data['subscription']['subscription_code'] ?? null;

        if ($subscriptionCode) {
            $adoption = Adoption::where('subscription_code', $subscriptionCode)->first();
            if ($adoption) {
                $adoption->status = Adoption::STATUS_ATTENTION;
                $adoption->save();

                Log::warning("Payment failed for adoption {$adoption->id}");
            }
        }
    }

    private function handleSubscriptionDisabled($data)
    {
        $subscriptionCode = $data['subscription_code'];
        $adoption = Adoption::where('subscription_code', $subscriptionCode)->first();

        if ($adoption) {
            $status = $data['status'] === 'complete' ?
                Adoption::STATUS_COMPLETED :
                Adoption::STATUS_CANCELLED;

            $adoption->status = $status;
            $adoption->save();

            Log::info("Subscription disabled for adoption {$adoption->id} with status: {$status}");
        }
    }

    private function handleSubscriptionNotRenew($data)
    {
        $subscriptionCode = $data['subscription_code'];
        $adoption = Adoption::where('subscription_code', $subscriptionCode)->first();

        if ($adoption) {
            $adoption->status = Adoption::STATUS_CANCELLED;
            $adoption->save();

            Log::info("Subscription set to not renew for adoption {$adoption->id}");
        }
    }
}
