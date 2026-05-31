@props([
    'type' => 'submit',
    'icon' => null,
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'admin-btn']) }}>
    @if ($icon)
        <i data-lucide="{{ $icon }}" class="h-4 w-4"></i>
    @endif
    {{ $slot }}
</button>
