<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') &mdash; {{ config('app.name', 'Indecor') }} Admin</title>

    {{-- Admin theme colours injected as CSS variables (config/theme.php → DB later) --}}
    @include('backend.partials.theme')

    @vite(['resources/css/backend/app.css', 'resources/js/backend/app.js'])

    @stack('styles')
</head>
<body class="admin-shell min-h-screen text-[var(--admin-ink)] antialiased">
    <div class="relative flex min-h-screen">
        @include('backend.partials.sidebar')

        <div class="admin-main flex min-w-0 flex-1 flex-col">
            @include('backend.partials.header')

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </main>

            @include('backend.partials.footer')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
