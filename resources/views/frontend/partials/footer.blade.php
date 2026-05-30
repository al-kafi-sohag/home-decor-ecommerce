@php
    $information = ['About Us', 'Delivery Information', 'Privacy Policy', 'Terms & Conditions', 'Contact Us'];
    $extras = ['Brands', 'Gift Certificates', 'Affiliate', 'Specials', 'Returns'];

    // Brand icons were dropped from lucide, so socials use inline SVG paths.
    $socials = [
        'Facebook'  => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z',
        'X'         => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z',
        'Instagram' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z',
        'YouTube'   => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z',
    ];
@endphp

<footer class="bg-gray-100 py-16 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            {{-- About --}}
            <div>
                <div class="mb-4">
                    @include('frontend.partials.logo', ['class' => 'h-10 w-auto'])
                </div>
                <p class="text-gray-600 text-sm mb-6">Mauris interdum magna eu neque convallis, vel laoreet lectus ultrices. Mauris at ullamcorper orci. Maecenas in nulla erat.</p>
                <div class="flex gap-3">
                    @foreach ($socials as $name => $path)
                        <a href="#" class="text-gray-500 hover-primary transition p-2 rounded-full bg-white border border-gray-200" aria-label="{{ $name }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="{{ $path }}"></path>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Information --}}
            <div>
                <h4 class="font-bold text-secondary mb-6">INFORMATION</h4>
                <ul class="space-y-4">
                    @foreach ($information as $item)
                        <li><a href="#" class="text-gray-600 hover-primary transition text-sm">{{ $item }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Extras --}}
            <div>
                <h4 class="font-bold text-secondary mb-6">EXTRAS</h4>
                <ul class="space-y-4">
                    @foreach ($extras as $item)
                        <li><a href="#" class="text-gray-600 hover-primary transition text-sm">{{ $item }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="font-bold text-secondary mb-6">SEND NEWSLETTER</h4>
                <p class="text-gray-600 text-sm mb-4">Sign up for our newsletter &amp; promotions</p>
                <form class="flex" onsubmit="return false;">
                    <input type="email" placeholder="email@example.com" class="flex-1 px-4 py-2 border border-gray-300 rounded-l text-sm focus:outline-none">
                    <button type="submit" class="btn-primary px-4 py-2 rounded-r text-sm font-semibold">SUBSCRIBE !</button>
                </form>
                <div class="mt-6">
                    <h5 class="font-bold text-secondary mb-3 text-sm">PAYMENTS</h5>
                    <div class="flex gap-3 flex-wrap text-gray-500">
                        <i data-lucide="credit-card" class="w-8 h-8"></i>
                        <i data-lucide="wallet" class="w-8 h-8"></i>
                        <i data-lucide="banknote" class="w-8 h-8"></i>
                        <i data-lucide="circle-dollar-sign" class="w-8 h-8"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer bottom --}}
        <div class="border-t border-gray-300 pt-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <p class="text-gray-600 text-sm">
                Copyright &copy; {{ date('Y') }} <a href="#" class="text-gray-600 hover-primary">Indecor</a>. All rights reserved.
            </p>
            <ul class="flex gap-6 text-sm">
                <li><a href="#" class="text-gray-600 hover-primary transition">About Us</a></li>
                <li><a href="#" class="text-gray-600 hover-primary transition">Customer Services</a></li>
                <li><a href="#" class="text-gray-600 hover-primary transition">Terms &amp; Conditions</a></li>
            </ul>
        </div>
    </div>
</footer>
