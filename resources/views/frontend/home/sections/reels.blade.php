<section class="py-20 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-gray-600 text-sm font-semibold mb-2">WATCH &amp; SHOP</p>
            <h2 class="text-4xl font-bold text-secondary">Product Reels</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($reels as $reel)
                <div class="group">
                    <div class="relative aspect-9/16 rounded-2xl overflow-hidden bg-black shadow-sm border border-gray-200"
                        data-youtube-lite
                        data-video-id="{{ $reel['video'] }}"
                        data-video-title="{{ $reel['title'] }}">
                        <button
                            type="button"
                            class="absolute inset-0 w-full h-full"
                            aria-label="Play {{ $reel['title'] }}">
                            <img
                                class="absolute inset-0 w-full h-full object-cover"
                                src="https://i.ytimg.com/vi/{{ $reel['video'] }}/hqdefault.jpg"
                                alt="{{ $reel['title'] }}"
                                loading="lazy"
                                decoding="async">
                            <span class="absolute inset-0 bg-black/35"></span>
                            <span class="relative z-10 inline-flex items-center justify-center w-full h-full">
                                <span class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-white/90 text-black shadow-lg transition-transform group-hover:scale-105">
                                    <svg class="h-6 w-6 ml-0.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M8 5.14v14l11-7-11-7z"></path>
                                    </svg>
                                </span>
                            </span>
                        </button>

                        <noscript>
                            <iframe
                                class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $reel['video'] }}"
                                title="{{ $reel['title'] }}"
                                loading="lazy"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen></iframe>
                        </noscript>
                    </div>
                    <h3 class="mt-4 font-bold text-secondary text-base group-hover:text-primary transition">{{ $reel['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
