<section class="py-20 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-gray-600 text-sm font-semibold mb-2">WATCH &amp; SHOP</p>
            <h2 class="text-4xl font-bold text-secondary">Product Reels</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($reels as $reel)
                <div class="group">
                    <div class="relative aspect-[9/16] rounded-2xl overflow-hidden bg-black shadow-sm border border-gray-200">
                        <iframe
                            class="absolute inset-0 w-full h-full"
                            src="https://www.youtube.com/embed/{{ $reel['video'] }}"
                            title="{{ $reel['title'] }}"
                            frameborder="0"
                            loading="lazy"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen></iframe>
                    </div>
                    <h3 class="mt-4 font-bold text-secondary text-base group-hover:text-primary transition">{{ $reel['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
