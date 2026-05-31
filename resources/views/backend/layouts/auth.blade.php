<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') &mdash; {{ config('app.name', 'Indecor') }}</title>

    @vite(['resources/css/backend/app.css', 'resources/js/backend/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">

        {{-- Brand / marketing panel --}}
        <aside class="relative hidden overflow-hidden bg-slate-900 lg:flex lg:flex-col lg:justify-between p-12 text-white">
            {{-- Decorative gradient blobs --}}
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -left-24 -top-24 h-96 w-96 rounded-full bg-indigo-600/40 blur-3xl"></div>
                <div class="absolute -bottom-24 -right-16 h-96 w-96 rounded-full bg-fuchsia-500/30 blur-3xl"></div>
                <div class="absolute left-1/2 top-1/3 h-72 w-72 rounded-full bg-violet-500/20 blur-3xl"></div>
            </div>

            <div class="relative">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 text-xl font-bold tracking-tight">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/20 backdrop-blur">
                        <i data-lucide="sofa" class="h-5 w-5"></i>
                    </span>
                    {{ config('app.name', 'Indecor') }}
                </a>
            </div>

            <div class="relative max-w-md">
                <h2 class="text-3xl font-semibold leading-tight">
                    Manage your store with ease.
                </h2>
                <p class="mt-4 text-sm leading-relaxed text-white/70">
                    Products, orders, customers and content — all in one beautifully simple admin panel.
                </p>

                <ul class="mt-8 space-y-3 text-sm text-white/80">
                    <li class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 ring-1 ring-white/15">
                            <i data-lucide="package" class="h-4 w-4"></i>
                        </span>
                        Effortless catalog &amp; inventory control
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 ring-1 ring-white/15">
                            <i data-lucide="shopping-bag" class="h-4 w-4"></i>
                        </span>
                        Real-time order tracking
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 ring-1 ring-white/15">
                            <i data-lucide="shield-check" class="h-4 w-4"></i>
                        </span>
                        Secure, role-based access
                    </li>
                </ul>
            </div>

            <p class="relative text-xs text-white/50">
                &copy; {{ date('Y') }} {{ config('app.name', 'Indecor') }}. All rights reserved.
            </p>
        </aside>

        {{-- Form panel --}}
        <main class="flex items-center justify-center px-5 py-10 sm:px-8">
            <div class="w-full max-w-md">
                {{-- Mobile brand (hidden on lg where the side panel shows it) --}}
                <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 text-xl font-bold tracking-tight text-slate-900 lg:hidden">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white">
                        <i data-lucide="sofa" class="h-4.5 w-4.5"></i>
                    </span>
                    {{ config('app.name', 'Indecor') }}
                </a>

                <div class="mb-7">
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-900">@yield('heading')</h1>
                    @hasSection('subheading')
                        <p class="mt-1.5 text-sm text-slate-500">@yield('subheading')</p>
                    @endif
                </div>

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
