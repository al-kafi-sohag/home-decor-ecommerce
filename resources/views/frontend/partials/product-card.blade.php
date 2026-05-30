{{-- Single product card. Expects $product = ['title', 'price', 'compare_price', 'badges'?] --}}
@php($badges = $product['badges'] ?? [])
<div class="product-card">
    <div class="relative bg-gray-100 rounded-lg h-64 overflow-hidden mb-4">
        @foreach ($badges as $i => $badge)
            <span class="absolute top-4 {{ $i === 0 ? 'left-4' : 'right-4' }} z-10 bg-gray-200 text-gray-700 px-3 py-1 text-xs font-semibold rounded">{{ $badge }}</span>
        @endforeach
        @include('frontend.partials.placeholder')
    </div>
    <h3 class="font-bold text-secondary mb-2">{{ $product['title'] }}</h3>
    <div class="flex gap-2 mb-4">
        <span class="text-primary font-bold">${{ number_format($product['price'], 2) }}</span>
        @if (!empty($product['compare_price']))
            <span class="text-gray-400 line-through">${{ number_format($product['compare_price'], 2) }}</span>
        @endif
    </div>
    <button type="button" class="btn-secondary w-full py-2 rounded transition">ADD TO CART</button>
</div>
