@props([
    'name',
    'label' => null,
    'value' => '1',
    'checked' => false,
])

@php
    $id = $attributes->get('id', $name);
    $isChecked = old($name, $checked) ? true : false;
@endphp

<label for="{{ $id }}" class="flex items-center gap-2 text-sm text-slate-600">
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked($isChecked)
        {{ $attributes->except('id')->merge(['class' => 'h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500']) }}>
    @if ($label){{ $label }}@endif
    {{ $slot }}
</label>
