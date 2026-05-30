<section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($features as $feature)
                <div class="border border-gray-300 rounded-lg p-6 flex items-center gap-4 hover:shadow-md transition">
                    <i data-lucide="{{ $feature['icon'] }}" class="w-8 h-8 text-primary flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold text-secondary">{{ $feature['title'] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
