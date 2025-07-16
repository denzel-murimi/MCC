<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-gray-200">500</h1>
                <div class="text-6xl font-bold text-gray-800 mb-4">
                    <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Server Error
                </div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    Something went wrong
                </h2>
                <p class="text-gray-600 mb-8">
                    We're experiencing some technical difficulties. Our team has been notified and is working to fix this issue.
                </p>
            </div>

            <div class="space-y-4">
                <button onclick="window.location.reload()"
                        class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Try Again
                </button>

                <a href="{{ url('/') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Go Back Home
                </a>

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
                    <strong>What can you do?</strong><br>
                    • Try refreshing the page<br>
                    • Wait a few minutes and try again<br>
                    • Contact support if the problem persists
                </p>
            </div>

            @if(config('app.debug'))
                <div class="mt-4 p-4 bg-gray-100 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-600">
                        Error ID: {{ uniqid() }}<br>
                        Time: {{ now()->format('Y-m-d H:i:s') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
