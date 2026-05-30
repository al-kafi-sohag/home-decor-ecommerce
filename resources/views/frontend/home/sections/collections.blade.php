@php
    // Bento layout map (md+ screens, 4-col x 2-row grid). Index order matches
    // the $collections array from the controller.
    $bento = [
        'md:col-span-1 md:row-span-2', // 0 - tall feature tile
        'md:col-span-2 md:row-span-1', // 1 - wide tile
        'md:col-span-1 md:row-span-1', // 2
        'md:col-span-1 md:row-span-1', // 3
        'md:col-span-1 md:row-span-1', // 4
        'md:col-span-1 md:row-span-1', // 5
    ];
@endphp

<section class="py-20" style="background-color: var(--bg-light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-gray-600 text-sm font-semibold mb-2">OUR COLLECTIONS</p>
            <h2 class="text-4xl font-bold text-secondary">HOT CATEGORIES IN THIS WEEK</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:auto-rows-[230px]">
            @foreach ($collections as $i => $collection)
                <a href="#" class="collection-card group relative rounded-2xl overflow-hidden border border-gray-200 bg-white min-h-[200px] {{ $bento[$i] ?? '' }}">
                    {{-- Placeholder image fills the tile --}}
                    <div class="absolute inset-0">
                        @include('frontend.partials.placeholder', ['icon' => $collection['icon']])
                    </div>

                    {{-- Gradient + label overlay --}}
                    <div class="absolute inset-0 z-[2] flex flex-col justify-end p-6 bg-gradient-to-t from-black/45 via-black/5 to-transparent">
                        <h3 class="text-white text-xl font-bold drop-shadow group-hover:text-primary transition">{{ $collection['name'] }}</h3>
                        <span class="text-white/80 text-sm">Shop now</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
