<x-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Sign In</h2>

       

@if ($errors->any())
    <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
        {{ $errors->first() }}
    </div>
@endif


        <form action="{{ route('signin.authenticate') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                Sign In
            </button>
        </form>

        
    </div>
</div>

</x-layout>
