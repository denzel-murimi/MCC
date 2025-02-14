<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mathare Care Center')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-black p-4 text-white flex justify-between items-center">
        <h1 class="text-2xl font-bold">Mathare Care Center</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="p-6">
        @yield('content')  {{-- This is where the child page content appears --}}
    </main>

    <footer class="bg-black p-4 text-white text-center">
        <p>Contact us: matharecarecenter@gmail.com </p>
    </footer>

</body>
</html>
