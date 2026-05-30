<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Colors
    |--------------------------------------------------------------------------
    |
    | These values are injected as CSS custom properties (variables) into the
    | master layout's <style> block. Every color in the frontend is driven by
    | these variables, so changing a value here re-themes the entire site.
    |
    | This array is intentionally the single source of truth. When a settings
    | table is added later, swap the values below for a DB lookup (e.g. via a
    | view composer or a cached Settings model) without touching any blade.
    |
    | The keys become CSS variables: 'primary' => '--primary'.
    |
    */

    'colors' => [
        'primary'      => env('THEME_PRIMARY', '#ff6b6b'),
        'primary-rgb'  => env('THEME_PRIMARY_RGB', '255, 107, 107'),
        'secondary'    => env('THEME_SECONDARY', '#1a1a1a'),
        'secondary-rgb' => env('THEME_SECONDARY_RGB', '26, 26, 26'),
        'border-color' => env('THEME_BORDER', '#e8e8e8'),
        'bg-light'     => env('THEME_BG_LIGHT', '#f9f9f9'),
        'text-dark'    => env('THEME_TEXT_DARK', '#333333'),
        'text-gray'    => env('THEME_TEXT_GRAY', '#666666'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Typography
    |--------------------------------------------------------------------------
    */

    'fonts' => [
        'body'    => "'Lato', sans-serif",
        'heading' => "'Playfair Display', serif",
    ],

];
