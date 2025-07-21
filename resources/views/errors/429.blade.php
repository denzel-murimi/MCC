<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-gray-200">429</h1>
                <div class="text-6xl font-bold text-gray-800 mb-4">
                    <svg class="w-16 h-16 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Too Many Requests
                </div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    Slow down there!
                </h2>
                <p class="text-gray-600 mb-8">
                    You've made too many requests in a short period of time. Please wait a moment before trying again.
                </p>
            </div>

            <div class="space-y-4">
                <button
                    class="inline-block bg-primary-500 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 cursor-not-allowed"
                        id="retryBtn"
                        >
                    Wait & Retry (30s)
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

            <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800">
                    <strong>What happened?</strong><br>
                    • You've exceeded the rate limit for requests<br>
                    • Please wait before making more requests<br>
                    • This helps us maintain service quality for everyone
                </p>
            </div>

            @if(config('app.debug'))
                <div class="mt-4 p-4 bg-gray-100 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-600">
                        Rate limit exceeded<br>
                        Time: {{ now()->format('Y-m-d H:i:s') }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Countdown timer for retry button
        let countdown = 60;
        const retryBtn = document.getElementById('retryBtn');

        const timer = setInterval(() => {
            countdown--;
            if (countdown > 0) {
                retryBtn.textContent = `Wait & Retry (${countdown}s)`;
            } else {
                retryBtn.textContent = 'Try Again';
                retryBtn.onclick = () => window.location.reload();
                retryBtn.disabled = false;
                retryBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                retryBtn.classList.add('bg-primary-600', 'hover:bg-primary-700', 'cursor-pointer');
                clearInterval(timer);
            }
        }, 1000);
    </script>
</x-layout>
