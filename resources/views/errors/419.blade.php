<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-gray-200">419</h1>
                <div class="text-6xl font-bold text-gray-800 mb-4">
                    <svg class="w-16 h-16 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Session Expired
                </div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                    Page Expired
                </h2>
                <p class="text-gray-600 mb-8">
                    Your session has expired due to inactivity. Please refresh the page and try again.
                </p>
            </div>

            <div class="space-y-4">
                <button onclick="window.location.reload()"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Refresh Page
                </button>

                <a href="{{ url('/') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Go Back Home
                </a>

                <div class="text-sm text-gray-500">
                    <p>Or try one of these:</p>
                    <div class="mt-2 space-x-4">
                        <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">Home</a>
                        <a href="javascript:history.back()" class="text-blue-600 hover:text-blue-800">Go Back</a>
                        @auth
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="text-red-600 hover:text-red-800">
                                Logout & Login Again
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800">
                    <strong>What happened?</strong><br>
                    For security reasons, forms expire after a period of inactivity. Simply refresh the page to get a new session.
                </p>
            </div>
        </div>
    </div>
</x-layout>
