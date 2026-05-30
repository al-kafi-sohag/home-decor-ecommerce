<section class="bg-gradient-to-b from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            {{-- Hero image --}}
            <div class="flex justify-center">
                <div class="w-full h-96 rounded-lg overflow-hidden">
                    @include('frontend.partials.placeholder', ['icon' => 'sofa'])
                </div>
            </div>

            {{-- Hero content --}}
            <div class="space-y-6">
                <p class="text-gray-600 text-sm">Let's refresh your space with this monthly offer</p>
                <h2 class="text-5xl md:text-6xl font-bold text-secondary leading-tight">TUMBLER ALARM CLOCK</h2>
                <button type="button" class="btn-primary px-8 py-3 font-semibold transition">SHOP NOW</button>
            </div>
        </div>
    </div>
</section>
