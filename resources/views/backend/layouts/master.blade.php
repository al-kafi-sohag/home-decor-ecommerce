<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') &mdash; {{ config('app.name', 'Indecor') }} Admin</title>

    @vite(['resources/css/backend/app.css', 'resources/js/backend/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar (expanded as the dashboard grows) --}}
        <aside class="hidden w-64 shrink-0 border-r border-slate-200 bg-white lg:block">
            <div class="flex h-16 items-center gap-2 border-b border-slate-200 px-6">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white">
                    <i data-lucide="sofa" class="h-4 w-4"></i>
                </span>
                <span class="font-bold tracking-tight">{{ config('app.name', 'Indecor') }}</span>
            </div>
            <nav class="space-y-1 p-4 text-sm">
                <a href="{{ route('backend.dashboard') }}"
                   class="flex items-center gap-3 rounded-lg bg-indigo-50 px-3 py-2 font-medium text-indigo-700">
                    <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                    Dashboard
                </a>
            </nav>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col">
            {{-- Topbar --}}
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-6">
                <h1 class="text-lg font-semibold">@yield('page-title', 'Dashboard')</h1>

                <form method="POST" action="{{ route('backend.auth.logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50">
                        <i data-lucide="log-out" class="h-4 w-4"></i>
                        Logout
                    </button>
                </form>
            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
