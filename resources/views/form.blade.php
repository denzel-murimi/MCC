<x-layout>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Complete Your Adoption</h1>

    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
        <img src="{{ $child->child_image_url }}" alt="{{ $child->name }}" class="w-full h-48 object-cover rounded-lg">
        <h2 class="text-xl font-semibold mt-4">{{ $child->name }}</h2>
        <p class="text-gray-600">{{ $child->condition }}</p>

        <form action="{{ route('adopt.store') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="child_id" value="{{ $child->id }}">
            
            <label class="block text-gray-700">Your Name:</label>
            <input type="text" name="name" class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block text-gray-700">Your Email:</label>
            <input type="email" name="email" class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block text-gray-700">Your Phone Number:</label>
            <input type="text" name="phone" class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block text-gray-700 text-sm font-bold mb-2">Contribution Type</label>
            <div class="flex gap-4 mb-6">
                <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl cursor-pointer transition hover:bg-gray-100">
                    <input type="radio" name="contribution_type" value="one-time" class="hidden peer" required>
                    <span class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-primary-500 peer-checked:bg-primary-500">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                    </span>
                    One-time
                </label>
                <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl cursor-pointer transition hover:bg-gray-100">
                    <input type="radio" name="contribution_type" value="recurring" class="hidden peer" required>
                    <span class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-primary-500 peer-checked:bg-primary-500">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                    </span>
                    Recurring
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="amount">Contribution Amount (KES)</label>
                <input type="number" name="amount" id="amount" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:outline-none" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Preferred Payment Method</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl cursor-pointer transition hover:bg-gray-100 peer-checked:bg-primary-500 peer-checked:text-white">
                        <input type="radio" name="payment_method" value="mpesa" class="hidden peer" required>
                        <i class="fa-solid fa-mobile-screen"></i>
                        M-Pesa
                    </label>
                    <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl cursor-pointer transition hover:bg-gray-100 peer-checked:bg-primary-500 peer-checked:text-white">
                        <input type="radio" name="payment_method" value="paypal" class="hidden peer" required>
                        <i class="fa-brands fa-paypal"></i>
                        PayPal
                    </label>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                Submit Adoption Pledge
            </button>
        </form>
    </div>
</div>

</x-layout>
