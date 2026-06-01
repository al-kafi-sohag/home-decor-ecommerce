@props([
    'title' => null,
    'subtitle' => null,
    'padded' => true,
])

{{-- Reusable surface used for forms, lists and panels. Optionally renders a
     header (title/subtitle + `actions` slot) and a `footer` slot. Pass
     :padded="false" when the body is a flush table or custom layout. --}}
<div {{ $attributes->merge(['class' => 'admin-card overflow-hidden']) }}>
    @if ($title || isset($actions))
        <div class="flex items-center justify-between gap-3 border-b border-[var(--admin-border)] px-5 py-4">
            <div>
                @if ($title)
                    <h3 class="text-base font-semibold text-[var(--admin-ink)]">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="text-xs text-[var(--admin-muted)]">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    @if ($padded)
        <div class="p-5">{{ $slot }}</div>
    @else
        {{ $slot }}
    @endif

    @isset($footer)
        <div class="flex items-center justify-end gap-2 border-t border-[var(--admin-border)] bg-[var(--admin-surface-alt)] px-5 py-3.5">
            {{ $footer }}
        </div>
    @endisset
</div>
