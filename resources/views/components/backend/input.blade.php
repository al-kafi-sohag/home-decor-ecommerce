@props([
    'name',
    'label' => null,
    'icon' => null,
    'value' => null,
    'togglePassword' => false,
])

@php
    // The DOM id defaults to the field name but can be overridden via id="".
    $id = $attributes->get('id', $name);

    $classes = 'admin-input'
        .($icon ? '' : ' no-icon')
        .($togglePassword ? ' pr-10' : '')
        .($errors->has($name) ? ' is-invalid' : '');
@endphp

<div>
    @if ($label || isset($action))
        <div class="mb-1.5 flex items-center justify-between">
            @if ($label)
                <label for="{{ $id }}" class="block text-sm font-medium text-slate-700">{{ $label }}</label>
            @endif
            {{ $action ?? '' }}
        </div>
    @endif

    <div class="relative">
        @if ($icon)
            <i data-lucide="{{ $icon }}" class="admin-field-icon"></i>
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $attributes->except('id')->merge(['class' => $classes]) }}>

        @if ($togglePassword)
            <button type="button" data-toggle-password="#{{ $id }}"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                aria-label="Toggle password visibility" aria-pressed="false" title="Show password">
                <i data-lucide="eye" class="h-4 w-4"></i>
            </button>
        @endif
    </div>

    @include('backend.includes.form-feedback', ['field' => $name])
</div>
