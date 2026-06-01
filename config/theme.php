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
    | Admin (backend) Palette
    |--------------------------------------------------------------------------
    |
    | The admin panel is themed with the same CSS-variable approach as the
    | storefront so the two stay visually cohesive. The brand accent defaults
    | to the storefront's primary colour; everything else is a professional
    | slate-based neutral set. Injected via the backend theme partial.
    |
    */

    'admin' => [
        'admin-primary'        => env('THEME_PRIMARY', '#ff6b6b'),
        'admin-primary-strong' => env('THEME_ADMIN_PRIMARY_STRONG', '#ef4d4d'),
        'admin-primary-soft'   => env('THEME_ADMIN_PRIMARY_SOFT', '#fff1f1'),
        'admin-primary-rgb'    => env('THEME_PRIMARY_RGB', '255, 107, 107'),

        'admin-ink'            => '#0f172a',
        'admin-ink-soft'       => '#334155',
        'admin-muted'          => '#64748b',
        'admin-faint'          => '#94a3b8',

        'admin-bg'             => '#f5f7fa',
        'admin-surface'        => '#ffffff',
        'admin-surface-alt'    => '#f8fafc',
        'admin-border'         => '#e7ebf0',

        'admin-success'        => '#16a34a',
        'admin-success-soft'   => '#e8f6ee',
        'admin-warning'        => '#b45309',
        'admin-warning-soft'   => '#fdf3e3',
        'admin-danger'         => '#dc2626',
        'admin-danger-soft'    => '#fdecec',
        'admin-info'           => '#2563eb',
        'admin-info-soft'      => '#e9f0fe',
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
