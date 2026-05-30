@php
    $navLinks = [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Products', 'url' => '#'],
        ['label' => 'About Us', 'url' => '#'],
    ];
@endphp

<header class="border-b border-gray-200 sticky top-0 bg-white z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center" aria-label="{{ config('app.name', 'Indecor') }}">
                @include('frontend.partials.logo', ['class' => 'h-10 w-auto'])
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden md:flex items-center gap-8">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['url'] }}" class="text-secondary hover-primary transition font-semibold">{{ $link['label'] }}</a>
                @endforeach
            </nav>

            {{-- Action icons --}}
            <div class="flex items-center gap-4">
                <button type="button" class="p-2 hover:bg-gray-100 rounded-lg transition" aria-label="Search">
                    <i data-lucide="search" class="w-5 h-5 text-secondary"></i>
                </button>
                <button type="button" class="p-2 hover:bg-gray-100 rounded-lg transition" aria-label="Account">
                    <i data-lucide="user" class="w-5 h-5 text-secondary"></i>
                </button>
                <button type="button" class="relative p-2 hover:bg-gray-100 rounded-lg transition" aria-label="Cart">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-secondary"></i>
                    <span class="absolute top-0 right-0 w-5 h-5 bg-primary text-white text-xs rounded-full flex items-center justify-center">0</span>
                </button>
                <span class="text-secondary font-semibold hidden sm:inline">$0.00</span>
            </div>

            {{-- Mobile menu button --}}
            <button type="button" class="md:hidden p-2" aria-label="Menu">
                <i data-lucide="menu" class="w-6 h-6 text-secondary"></i>
            </button>
        </div>
    </div>
</header>
