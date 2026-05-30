<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl font-bold mb-4"><span class="underline-accent">NEW ARRIVALS</span></h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            @foreach ($newArrivals as $product)
                @include('frontend.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
