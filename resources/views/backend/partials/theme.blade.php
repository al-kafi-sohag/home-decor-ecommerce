{{-- Outputs admin theme colors as CSS custom properties, mirroring the
     storefront's approach (config/theme.php today; swap for a settings/DB
     lookup later and the whole admin panel re-themes automatically). --}}
<style>
    :root {
        @foreach (config('theme.admin') as $name => $value)
        --{{ $name }}: {{ $value }};
        @endforeach
    }
</style>
