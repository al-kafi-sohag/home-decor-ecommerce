@props([
    'user' => null,    // any model exposing avatarUrl() + initials() (e.g. Admin)
    'url' => null,     // or pass an explicit image URL
    'name' => null,    // and a name (used for the initials fallback)
    'size' => 40,      // rendered size in pixels
    'circle' => true,
])

@php
    $resolvedUrl = $url ?? ($user && method_exists($user, 'avatarUrl') ? $user->avatarUrl() : null);
    $resolvedName = $name ?? $user?->name ?? 'Admin';

    if ($user && method_exists($user, 'initials')) {
        $initials = $user->initials();
    } else {
        $initials = \Illuminate\Support\Str::of($resolvedName)
            ->trim()->explode(' ')->filter()->take(2)
            ->map(fn ($p) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($p, 0, 1)))
            ->implode('') ?: 'NA';
    }

    $shape = $circle ? 'rounded-full' : 'rounded-lg';
    $fontSize = max(10, (int) round($size * 0.4));
@endphp

@if ($resolvedUrl)
    <img
        src="{{ $resolvedUrl }}"
        alt="{{ $resolvedName }}"
        {{ $attributes->merge(['class' => $shape.' shrink-0 object-cover']) }}
        style="height: {{ $size }}px; width: {{ $size }}px;">
@else
    <span
        {{ $attributes->merge(['class' => $shape.' inline-flex shrink-0 items-center justify-center font-semibold text-white']) }}
        style="height: {{ $size }}px; width: {{ $size }}px; font-size: {{ $fontSize }}px; background-color: var(--admin-primary);"
        aria-label="{{ $resolvedName }}">{{ $initials }}</span>
@endif
