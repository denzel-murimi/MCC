<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-gray-200">503</h1>
                <div class="text-6xl font-bold text-gray-800 mb-4">
                    <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Service Unavailable
                </div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    We're temporarily down
                </h2>
                <p class="text-gray-600 mb-8">
                    Our service is currently undergoing maintenance or experiencing technical difficulties. We'll be back shortly.
                </p>
            </div>

            <div class="space-y-4">
                <button
                    class="inline-block bg-primary-500 hover:bg-primary-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200"
                    onclick="window.location.reload()"
                >
                    Try Again
                </button>

                <div class="text-sm text-gray-500">
                    <p>Or try one of these:</p>
                    <div class="mt-2 space-x-4">
                        <a href="{{ url('/') }}" class="text-primary-600 hover:text-primary-800">Home</a>
                        <a href="javascript:history.back()" class="text-primary-600 hover:text-primary-800">Go Back</a>
                        <a href="mailto:support@matharecarecenter.com" class="text-primary-600 hover:text-primary-800">Contact Support</a>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-sm text-red-800">
                    <strong>What's happening?</strong><br>
                    • The service is temporarily unavailable<br>
                    • This could be due to maintenance or high traffic<br>
                    • Please try again in a few minutes
                </p>
            </div>

            @if(config('app.debug'))
                <div class="mt-4 p-4 bg-gray-100 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-600">
                        Service Unavailable<br>
                        Time: {{ now()->format('Y-m-d H:i:s') }}<br>
                        @if(isset($exception))
                            Message: {{ $exception->getMessage() }}
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
