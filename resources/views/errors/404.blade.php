<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-gray-200">404</h1>
                <div class="text-6xl font-bold text-gray-800 mb-4">Oops!</div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    Page Not Found
                </h2>
                <p class="text-gray-600 mb-8">
                    The page you're looking for doesn't exist or has been moved.
                </p>
            </div>

            <div class="space-y-4">
                <a href="{{ url('/') }}"
                   class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Go Back Home
                </a>

                <div class="text-sm text-gray-500">
                    <p>Or try one of these:</p>
                    <div class="mt-2 space-x-4">
                        <a href="{{ url('/') }}" class="text-primary-600 hover:text-primary-800">Home</a>
                        <a href="javascript:history.back()" class="text-primary-600 hover:text-primary-800">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
