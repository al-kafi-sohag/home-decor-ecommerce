@props([
    'name',                 // base field key — emits `{name}_token` + `{name}_remove`
    'label' => null,
    'value' => null,        // current image URL (edit mode)
    'aspectRatio' => 1,     // cropper aspect ratio (e.g. 1, 16/9, or 0 for free)
    'circle' => false,      // round preview / crop (avatars)
    'hint' => null,
])

@php
    $tokenField = $name.'_token';
    $removeField = $name.'_remove';
    $hasExisting = filled($value);
    $previewShape = $circle ? 'rounded-full' : 'rounded-xl';
@endphp

<div
    data-image-uploader
    data-field="{{ $name }}"
    data-upload-url="{{ route('backend.media.upload') }}"
    data-aspect="{{ $aspectRatio }}"
    data-circle="{{ $circle ? '1' : '0' }}"
    data-has-existing="{{ $hasExisting ? '1' : '0' }}">

    @if ($label)
        <p class="mb-2 block text-xs font-semibold uppercase tracking-[0.08em] text-slate-600">{{ $label }}</p>
    @endif

    <div class="flex items-center gap-4">
        {{-- Preview --}}
        <div class="relative h-24 w-24 shrink-0 overflow-hidden border border-[var(--admin-border)] bg-[var(--admin-surface-alt)] {{ $previewShape }}">
            <img
                data-uploader-image
                src="{{ $value }}"
                alt=""
                class="h-full w-full object-cover {{ $hasExisting ? '' : 'hidden' }}">

            <div
                data-uploader-empty
                class="flex h-full w-full items-center justify-center text-[var(--admin-faint)] {{ $hasExisting ? 'hidden' : '' }}">
                <i data-lucide="image" class="h-7 w-7"></i>
            </div>

            {{-- Upload spinner overlay --}}
            <div
                data-uploader-loading
                class="absolute inset-0 hidden items-center justify-center bg-white/70">
                <i data-lucide="loader-circle" class="h-6 w-6 animate-spin" style="color: var(--admin-primary);"></i>
            </div>
        </div>

        {{-- Actions --}}
        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-2">
                <button
                    type="button"
                    data-uploader-pick
                    class="inline-flex items-center gap-2 rounded-lg border border-[var(--admin-border)] bg-white px-3.5 py-2 text-sm font-medium text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]">
                    <i data-lucide="upload" class="h-4 w-4"></i>
                    <span data-uploader-pick-label>{{ $hasExisting ? 'Change image' : 'Upload image' }}</span>
                </button>

                <button
                    type="button"
                    data-uploader-remove-btn
                    class="inline-flex items-center gap-2 rounded-lg border border-[var(--admin-border)] bg-white px-3 py-2 text-sm font-medium text-[var(--admin-danger)] transition hover:bg-[var(--admin-danger-soft)] {{ $hasExisting ? '' : 'hidden' }}">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                </button>
            </div>

            @if ($hint)
                <p class="mt-1.5 text-xs text-[var(--admin-muted)]">{{ $hint }}</p>
            @endif

            <p data-uploader-status class="mt-1 hidden text-xs"></p>
        </div>
    </div>

    {{-- Hidden inputs submitted with the parent form --}}
    <input type="file" accept="image/png,image/jpeg,image/webp" class="hidden" data-uploader-file>
    <input type="hidden" name="{{ $tokenField }}" value="" data-uploader-token>
    <input type="hidden" name="{{ $removeField }}" value="0" data-uploader-remove>

    @include('backend.includes.form-feedback', ['field' => $tokenField])
</div>
