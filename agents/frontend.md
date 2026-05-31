# Frontend (Storefront) — Agent Guide

The public-facing store. Everything here is namespaced under `frontend`.

## Directory map

```
app/Http/Controllers/Frontend/      # storefront controllers (e.g. HomeController)
resources/views/frontend/
  layouts/master.blade.php           # base HTML shell (header, content, footer)
  partials/                          # header, footer, logo, theme, product-card, placeholder
  home/index.blade.php               # page composed of sections
  home/sections/                     # hero, features, new-arrivals, collections, products, reels
resources/css/app.css                # CSS entry → imports frontend/main.css
resources/css/frontend/main.css      # storefront styles
resources/js/app.js                  # JS entry → exposes jQuery, imports frontend/main.js
resources/js/frontend/main.js        # storefront scripts (lucide init, interactions)
config/theme.php                     # theme colors + fonts (single source of truth)
routes/web.php                       # storefront routes
```

## Routing

- Storefront routes live in `routes/web.php`.
- Route names have **no prefix** (e.g. `home`). Keep them descriptive.
- Controllers return a `View`. Type-hint the return (`: View`).

```php
Route::get('/', [HomeController::class, 'index'])->name('home');
```

## Controllers

- Namespace: `App\Http\Controllers\Frontend`.
- Today data is **static arrays shaped like the eventual DB rows**, so blades stay
  unchanged when models/queries are wired in. Follow that pattern — see
  `HomeController::index()` for the canonical example (`$products`, `$collections`…).
- Pass data to views with `compact(...)`.

## Blade conventions

- Pages `@extends('frontend.layouts.master')` and fill `@section('content')`.
- Break pages into **sections** (`home/sections/*`) and `@include` them from the
  page index. Reusable bits go in `partials/`.
- Use `@yield('title', config('app.name'))` for the page title.
- Use `@stack('styles')` / `@stack('scripts')` for page-specific assets.

## Theming

- Colors and fonts come from `config/theme.php`.
- `frontend/partials/theme.blade.php` prints them as CSS custom properties
  (`--primary`, `--secondary`, …) into a `<style>` block in `<head>`.
- **Never hardcode a hex color in a blade.** Use the CSS variable or the helper
  classes in `frontend/main.css` (`.text-primary`, `.bg-secondary`, `.btn-primary`).
- When a settings/DB table arrives, swap the `config('theme.*')` lookups for the
  DB source — the rest of the frontend re-themes automatically.

## Assets (Vite + Tailwind v4)

- Entry points registered in `vite.config.js`: `resources/css/app.css`,
  `resources/js/app.js`.
- Tailwind v4 is configured via `@import 'tailwindcss'` and `@source` directives
  inside `app.css` (no `tailwind.config.js`). If you add blade files in a **new
  top-level views dir**, make sure a `@source` covers it.
- **jQuery** is global as `window.$` (set in `app.js`).
- **Lucide icons:** drop `<i data-lucide="icon-name"></i>` in markup; it's rendered
  to SVG by `createIcons({ icons })` in `main.js`.

### Asset gotchas (learned the hard way)

- Any `main.js` that uses `$` must **`import $ from 'jquery'` itself**. Relying on
  `window.$` fails because ES `import` statements are hoisted and run before the
  entry assigns `window.$`.
- After `npm run build`, the `public/hot` file is **not** removed. If you build but
  then run only `php artisan serve`, delete `public/hot` or assets will try to load
  from the (stopped) Vite dev server. `npm run dev` recreates it.

## Adding a new storefront page (checklist)

1. Add a `Frontend\` controller method returning a `View` (static data shaped like
   future DB rows).
2. Create `resources/views/frontend/<page>/index.blade.php` extending the master
   layout; split large pages into `sections/`.
3. Register a named route in `routes/web.php`.
4. Reuse theme variables / helper classes for all colors.
5. If you add JS/CSS, put it under `resources/{js,css}/frontend/` and import from
   the entry file. Rebuild assets.
