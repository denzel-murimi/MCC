<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Mathare Care Centre')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}" @cspNonce">
    <!-- Styles / Scripts -->
    <script @cspNonce type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script @cspNonce nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
    <style @cspNonce>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script src="{{ Vite::asset('resources/js/app.js') }}" type="module" @cspNonce></script>
</head>
<!-- Google tag (gtag.js) -->
<script @cspNonce async src="https://www.googletagmanager.com/gtag/js?id=G-KJPGJQ1XL1"></script>
<script @cspNonce>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-KJPGJQ1XL1');
</script>
<body
    class="font-sans antialiased"
>
<!-- Global Alert Popup -->
<div id="alert-container" class="fixed top-30 right-4 z-50 space-y-2"></div>


{{ $slot }}
<script id="flash-data" type="application/json" @cspNonce>
    @php
        $flashMessages = [];
        if(session('error')) $flashMessages[] = ['text' => session('error'), 'type' => 'error'];
        if(session('success')) $flashMessages[] = ['text' => session('success'), 'type' => 'success'];
        if(session('info')) $flashMessages[] = ['text' => session('info'), 'type' => 'info'];
        if(session('warning')) $flashMessages[] = ['text' => session('warning'), 'type' => 'warning'];
    @endphp
    {!! json_encode($flashMessages) !!}
</script>

<!-- Flash Script -->
<script @cspNonce>
    const alertContainer = document.getElementById('alert-container');

    const ICONS = {
        success: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
        error: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
        info: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
        warning: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>`
    };

    const getAlertClasses = (type) => {
        const base = `text-white px-4 py-2 rounded-lg shadow-lg flex items-center gap-2 max-w-xs transition transform duration-300 opacity-0 scale-90 space-x-2`;
        const colors = {
            success: `bg-green-500`,
            error: `bg-red-500`,
            info: `bg-blue-500`,
            warning: `bg-yellow-500`,
        };
        return `${base} ${colors[type] || 'bg-gray-500'}`;
    };

    const showMessage = (text, type = 'info') => {
        const wrapper = document.createElement('div');
        wrapper.className = getAlertClasses(type);

        wrapper.innerHTML = `
            ${ICONS[type] || ''}
            <span>${text}</span>
            <button class="ml-auto hover:bg-white hover:bg-opacity-25 rounded-full p-1" aria-label="Close Alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;

        const closeBtn = wrapper.querySelector('button');
        closeBtn.addEventListener('click', () => {
            wrapper.classList.replace('opacity-100', 'opacity-0');
            wrapper.classList.replace('scale-100', 'scale-90');
            setTimeout(() => wrapper.remove(), 300);
        });

        alertContainer.appendChild(wrapper);
        requestAnimationFrame(() => {
            wrapper.classList.replace('opacity-0', 'opacity-100');
            wrapper.classList.replace('scale-90', 'scale-100');
        });

        setTimeout(() => closeBtn.click(), 8000);
    };

    // Global functions for usage elsewhere
    window.showSuccess = (msg) => showMessage(msg, 'success');
    window.showError = (msg) => showMessage(msg, 'error');
    window.showInfo = (msg) => showMessage(msg, 'info');
    window.showWarning = (msg) => showMessage(msg, 'warning');

    // Handle flash messages
    try {
        const flashData = JSON.parse(document.getElementById('flash-data')?.textContent || '[]');
        flashData.forEach(({ text, type }) => showMessage(text, type));
    } catch (e) {
        console.error('Flash message parse error:', e);
    }
</script>
</body>
</html>
