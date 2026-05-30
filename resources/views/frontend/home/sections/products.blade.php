<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12 gap-6">
            <h2 class="text-4xl font-bold text-secondary border-l-4 border-primary pl-4">OUR<br>PRODUCTS</h2>

            <div class="flex gap-4">
                @foreach ($productTabs as $i => $tab)
                    <button type="button" class="{{ $i === 0 ? 'text-primary font-semibold border-b-2 border-primary pb-2' : 'text-gray-600 hover-primary transition' }}">{{ $tab }}</button>
                @endforeach
            </div>

            <div class="flex gap-2">
                <button type="button" class="p-2 border border-gray-300 rounded hover:bg-gray-100 transition" aria-label="Previous">
                    <i data-lucide="chevron-left" class="w-5 h-5 text-gray-400"></i>
                </button>
                <button type="button" class="p-2 border border-gray-300 rounded hover:bg-gray-100 transition" aria-label="Next">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                @include('frontend.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
