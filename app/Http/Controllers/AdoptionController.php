<?php

namespace App\Http\Controllers;

    use App\Support\Facade\Hashids;
    use Illuminate\Http\Request;
    use App\Models\Adoption;
    use App\Models\AdoptionTransaction;
    use App\Models\Child;
    use Illuminate\Support\Facades\Log;
    use GuzzleHttp\Client;

class AdoptionController extends Controller
{
    private $client;
    private $paystackKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->paystackKey = config('paystack.secretKey');
    }

    /**
     * Show the adoption form.
     */
    public function index()
    {
        $children = Child::all();
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
    public function store(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'amount' => 'required|numeric|min:1',
                'contribution_type' => 'required|string|in:one-time,recurring',
                'frequency' => 'required_if:contribution_type,recurring|string|in:hourly,daily,weekly,monthly,quarterly,biannually,annually',
                'duration' => 'nullable|integer|min:1|max:120', // Max 10 years for monthly
            ]);

            // Create adoption record
            $adoption = $this->createAdoption($request, $id);

            if ($request->contribution_type === 'recurring') {
                return $this->handleRecurringPayment($adoption, $request);
            } else {
                return $this->handleOneTimePayment($adoption, $request);
            }

        } catch (\Throwable $th) {
            Log::error('Adoption Store Error: ', [$th]);
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    private function createAdoption(Request $request, string $childId)
    {
        $reference = 'ADOPT_' . time() . '_' . uniqid();

        return Adoption::create([
            'child_id' => $childId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contribution_type' => $request->contribution_type,
            'amount' => $request->amount,
            'frequency' => $request->contribution_type === 'recurring' ? $request->frequency : null ,
            'duration' => $request->contribution_type === 'recurring' ? $request->duration : 1,
            'reference' => $reference,
            'status' => Adoption::STATUS_REQUESTED,
            'metadata' => [
                'donor_name' => $request->name,
                'phone' => $request->phone,
                'purpose' => 'adoption',
                'child_id' => $childId,
            ],
            'total_payments_made' => 0,
            'total_amount_paid' => 0,
        ]);
    }

    private function handleRecurringPayment(Adoption $adoption, Request $request)
    {
        // Create or find plan
        $planCode = $this->createOrFindPlan($adoption);

        // Update adoption with plan code
        $adoption->update(['plan_code' => $planCode]);

        // Initialize transaction with plan
        $paymentData = [
            'email' => $request->email,
            'amount' => $request->amount * 100,
            'plan' => $planCode,
            'callback_url' => route('paystack.callback'),
            'reference' => $adoption->reference,
            'metadata' => $adoption->metadata,
        ];

        $response = $this->client->post('https://api.paystack.co/transaction/initialize', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->paystackKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $paymentData,
        ]);

        $data = json_decode($response->getBody(), true)['data'];

        // Create initial transaction record
        $this->createTransaction($adoption, $data['reference'], AdoptionTransaction::TYPE_INITIAL);

        session(['paystack_reference_adoption' => $data['reference']]);

        return redirect($data['authorization_url']);
    }

    private function handleOneTimePayment(Adoption $adoption, Request $request)
    {
        $paymentData = [
            'amount' => $request->amount * 100,
            'email' => $request->email,
            'currency' => 'KES',
            'reference' => $adoption->reference,
            'callback_url' => route('paystack.callback'),
            'metadata' => $adoption->metadata,
        ];

        // Create initial transaction record
        $this->createTransaction($adoption, $adoption->reference, AdoptionTransaction::TYPE_ONE_TIME);

        session(['paystack_reference_adoption' => $adoption->reference]);

        return (new \Unicodeveloper\Paystack\Paystack)->getAuthorizationUrl($paymentData)->redirectNow();
    }

    private function createOrFindPlan(Adoption $adoption)
    {
        $child_id = Hashids::encode($adoption->child_id);
        $planName = "Adoption_{$child_id}_{$adoption->amount}_{$adoption->frequency}";

        // Check for existing plan
        $existingPlan = $this->findExistingPlan($planName, $adoption->amount, $adoption->frequency);

        if ($existingPlan) {
            return $existingPlan['plan_code'];
        }

        // Create new plan
        return $this->createPlan($planName, $adoption->amount, $adoption->frequency, $adoption->duration);
    }
    private function findExistingPlan(string $planName, float $amount, string $frequency)
    {
        try {
            $response = $this->client->get('https://api.paystack.co/plan', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->paystackKey,
                    'Accept' => 'application/json',
                ],
                'query' => ['perPage' => 100],
            ]);

            $plans = json_decode($response->getBody(), true)['data'];

            foreach ($plans as $plan) {
                if ($plan['name'] === $planName &&
                    $plan['amount'] == $amount * 100 &&
                    $plan['interval'] === $frequency &&
                    $plan['currency'] === 'KES') {
                    return $plan;
                }
            }
        } catch (\Exception $e) {
            Log::error('Error finding existing plan: ' . $e->getMessage());
        }

        return null;
    }
    private function createPlan(string $planName, float $amount, string $frequency, ?int $duration)
    {
        $planData = [
            'name' => $planName,
            'amount' => $amount * 100,
            'interval' => $frequency,
            'currency' => 'KES',
        ];

        if ($duration) {
            $planData['invoice_limit'] = $duration;
        }

        $response = $this->client->post('https://api.paystack.co/plan', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->paystackKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $planData,
        ]);

        return json_decode($response->getBody(), true)['data']['plan_code'];
    }

    private function createTransaction(Adoption $adoption, string $reference, string $type)
    {
        return AdoptionTransaction::create([
            'adoption_id' => $adoption->id,
            'reference' => $reference,
            'amount' => $adoption->amount,
            'currency' => 'KES',
            'type' => $type,
            'status' => AdoptionTransaction::STATUS_PENDING,
            'metadata' => $adoption->metadata,
        ]);
    }

}
