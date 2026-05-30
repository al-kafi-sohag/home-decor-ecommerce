{{-- Outputs theme colors as CSS custom properties. Driven by config/theme.php
     today; replace the config() call with a settings/DB lookup later and the
     rest of the frontend re-themes automatically. --}}
<style>
    :root {
        @foreach (config('theme.colors') as $name => $value)
        --{{ $name }}: {{ $value }};
        @endforeach
        --font-body: {{ config('theme.fonts.body') }};
        --font-heading: {{ config('theme.fonts.heading') }};
    }
</style>
