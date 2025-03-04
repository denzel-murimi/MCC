<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Mathare Care Centre')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KJPGJQ1XL1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-KJPGJQ1XL1');
</script>
<body
    x-data="messageManager()"
    x-init="initMessageHandler()"
    class="font-sans antialiased"
>
<!-- Global Alert Popup -->
<div class="fixed top-30 right-4 z-50 space-y-2">
    <template x-for="(message, index) in messages" :key="index">
        <div
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            :class="{
                'bg-red-500': message.type === 'error',
                'bg-green-500': message.type === 'success',
                'bg-blue-500': message.type === 'info',
                'bg-yellow-500': message.type === 'warning',
                'text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2': true
            }"
        >
            <!-- Dynamic Icon based on message type -->
            <svg x-show="message.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg x-show="message.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg x-show="message.type === 'info'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg x-show="message.type === 'warning'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>

            <span x-text="message.text"></span>
            <button
                @click="removeMessage(index)"
                class="ml-2 hover:bg-opacity-25 rounded-full p-1"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>


<div class="container max-w-screen-2xl mx-auto px-4">
    <x-navbar></x-navbar>
</div>
{{ $slot }}
<x-footer></x-footer>

<script>
    // Alpine component for message management
    function messageManager() {
        return {
            messages: [],

            addMessage(text, type = 'error') {
                this.messages.push({ text, type });
                setTimeout(() => {
                    this.removeMessage(0);
                }, 8000);
            },

            removeMessage(index) {
                this.messages.splice(index, 1);
            },

            initMessageHandler() {
                // Expose global message functions with different types
                window.showError = (message) => {
                    this.addMessage(message, 'error');
                };
                window.showSuccess = (message) => {
                    this.addMessage(message, 'success');
                };
                window.showInfo = (message) => {
                    this.addMessage(message, 'info');
                };
                window.showWarning = (message) => {
                    this.addMessage(message, 'warning');
                };
                window.removeMessage = (index) => {
                    this.removeMessage(index);
                };

                // Handle Laravel flash messages
                @if(session('error'))
                    this.addMessage('{{ session('error') }}', 'error');
                @endif
                    @if(session('success'))
                    this.addMessage('{{ session('success') }}', 'success');
                @endif
                    @if(session('info'))
                    this.addMessage('{{ session('info') }}', 'info');
                @endif
                    @if(session('warning'))
                    this.addMessage('{{ session('warning') }}', 'warning');
                @endif
            }
        };
    }
</script>

</body>
</html>
