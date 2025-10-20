<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'License Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if (Auth::check())
            @include('layouts.navigation')
        @endif

        <!-- Page Content -->
        <main class="p-6">
            @yield('content') {{-- ✅ Use @yield instead of $slot --}}
        </main>
    </div>
</body>
</html>
