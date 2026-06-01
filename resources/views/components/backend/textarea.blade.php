@props([
    'name',
    'label' => null,
    'value' => null,
    'rows' => 4,
    'hint' => null,
])

@php
    // The DOM id defaults to the field name but can be overridden via id="".
    $id = $attributes->get('id', $name);

    $classes = 'admin-input no-icon resize-y'
        .($errors->has($name) ? ' is-invalid' : '');
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-slate-700">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->except('id')->merge(['class' => $classes]) }}>{{ old($name, $value) }}</textarea>

    @if ($hint)
        <p class="mt-1.5 text-xs text-[var(--admin-muted)]">{{ $hint }}</p>
    @endif

    @include('backend.includes.form-feedback', ['field' => $name])
</div>
