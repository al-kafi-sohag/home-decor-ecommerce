@props([
    'title',
    'subtitle' => null,
])

{{-- Standard page heading used across every admin screen: title + optional
     subtitle on the left, optional action buttons (passed via the `actions`
     slot) on the right. --}}
<div {{ $attributes->merge(['class' => 'mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between']) }}>
    <div>
        <h2 class="text-xl font-semibold text-[var(--admin-ink)]">{{ $title }}</h2>
        @if ($subtitle)
            <p class="mt-0.5 text-sm text-[var(--admin-muted)]">{{ $subtitle }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
