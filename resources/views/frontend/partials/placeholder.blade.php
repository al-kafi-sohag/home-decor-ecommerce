{{-- Reusable SVG image placeholder. Pass $icon to change the glyph.
     Swap the inner markup for a real <img> tag once media is dynamic. --}}
@php($icon = $icon ?? 'image')
<div class="img-placeholder">
    <i data-lucide="{{ $icon }}"></i>
</div>
