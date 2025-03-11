<x-layout>
    
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Support Mathare Care Center</h1>
    <p class="mb-4">Your donation helps us continue our mission to provide support and care for the community.</p>
    
    <!-- Payment Options -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- M-Pesa Payment -->
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Donate via M-Pesa</h2>
    
    <form method="POST" action="{{ route('mpesa.donate') }}" class="space-y-4">
        @csrf

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-600">Phone Number (2547xxxxxxxx)</label>
            <input type="text" name="phone" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div>
            <label for="amount" class="block text-sm font-medium text-gray-600">Amount (KES)</label>
            <input type="number" name="amount" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
            Donate via M-Pesa
        </button>
    </form>
</div>


        
        <!-- PayPal Payment -->
        <div class="border p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-3">Donate via PayPal</h2>
            <form action="{{ route('paypal.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Donate with PayPal
                </button>
            </form>
        </div>
    </div>
</div>


</x-layout>