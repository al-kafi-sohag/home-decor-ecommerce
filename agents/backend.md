# Backend (Admin Panel) — Agent Guide

The admin area, served under the `/admin` URL prefix with the `backend.` route-name
prefix and a dedicated `admin` auth guard. Everything is namespaced under `backend`.

## Directory map

```
app/Http/Controllers/Backend/
  DashboardController.php
  Auth/{LoginController,ForgotPasswordController,ResetPasswordController}.php
app/Http/Requests/Backend/Auth/      # LoginRequest, ForgotPasswordRequest, ResetPasswordRequest
app/Services/Backend/Auth/           # AuthService, PasswordResetService
app/Notifications/Admin/             # AdminResetPasswordNotification
app/Models/Admin.php                 # admin auth model
app/Enums/AdminStatus.php            # Inactive(0) / Active(1) / Deleted(-1)
app/Traits/AuditColumnsTrait.php     # created_by/updated_by/deleted_by + FKs to admins
resources/views/backend/
  layouts/auth.blade.php             # split-screen layout for auth screens
  layouts/master.blade.php           # dashboard shell (sidebar + topbar)
  partials/flash.blade.php           # session status + validation errors
  auth/{login,forgot-password,reset-password}.blade.php
  dashboard/index.blade.php
resources/css/backend/app.css        # CSS entry → imports backend/main.css
resources/css/backend/main.css       # admin styles (.admin-input, .admin-btn, tokens)
resources/js/backend/app.js          # JS entry → exposes jQuery, imports backend/main.js
resources/js/backend/main.js         # admin scripts (lucide init, password toggle)
routes/backend.php                   # all admin routes (loaded from bootstrap/app.php)
```

## Authentication architecture

- **Guard:** `admin` (session). **Provider:** `admins` (Eloquent → `Admin`).
  **Password broker:** `admins` (table `admin_password_reset_tokens`).
  All three are defined in `config/auth.php`.
- `routes/backend.php` is registered via the `then:` closure in `bootstrap/app.php`
  (loaded with `web` middleware).
- Guest-only screens use `middleware('guest:admin')`; protected screens use
  `middleware('auth:admin')`.
- `bootstrap/app.php` sets `redirectGuestsTo` → `backend.auth.login` and
  `redirectUsersTo` → `backend.dashboard` for `/admin/*` requests.

### Route names (keep this scheme)

| Method | URI | Name |
| --- | --- | --- |
| GET | `admin/login` | `backend.auth.login` |
| POST | `admin/login` | `backend.auth.login.store` |
| POST | `admin/logout` | `backend.auth.logout` |
| GET | `admin/forgot-password` | `backend.auth.fp` |
| POST | `admin/forgot-password` | `backend.auth.fp.email` |
| GET | `admin/reset-password/{token}` | `backend.auth.rp` |
| POST | `admin/reset-password` | `backend.auth.rp.store` |
| GET | `admin/dashboard` | `backend.dashboard` |

> `AdminResetPasswordNotification` builds its link from `route('backend.auth.rp', …)`.
> If you rename that route, update the notification.

### Default seeded admin

`admin@example.com` / `password` (see `database/seeders/AdminSeeder.php`).

## The request → service → controller pattern (FOLLOW THIS)

Controllers are **thin**. Validation lives in a FormRequest; logic lives in a Service.

```php
// Controller: orchestrate only
public function store(LoginRequest $request): RedirectResponse
{
    $this->authService->login($request, $request->only('email', 'password'), $request->boolean('remember'));
    return redirect()->intended(route('backend.dashboard'));
}
```

- **FormRequests** (`App\Http\Requests\Backend\...`): `authorize()` + `rules()`,
  plus `messages()` / `attributes()` for friendly errors. Validate against the
  `admins` table (`exists:admins,email`).
- **Services** (`App\Services\Backend\...`): all business logic. Throw
  `ValidationException::withMessages([...])` for user-facing failures (e.g. failed
  login, inactive account). The `admins` password broker is wrapped by
  `PasswordResetService`.
- **Controllers**: resourceful method names — `create` (show form), `store`
  (handle submit), `destroy` (logout/delete). Constructor-inject services.

## Models, Enums, Traits

- `Admin` extends `Illuminate\Foundation\Auth\User`, uses `Notifiable`,
  `SoftDeletes`, `HasFactory`. `status` is cast to `AdminStatus`; `password` is
  `hashed`. It overrides `sendPasswordResetNotification()` to use the admin
  notification.
- **Enums** (`app/Enums`): backed enums with helper methods. `AdminStatus` exposes
  `label()`, `color()` (Tailwind token), `canLogin()`. Add new statuses/types as
  enums — never raw ints/strings in code.
- **Traits** (`app/Traits`): `AuditColumnsTrait` adds `created_by/updated_by/
  deleted_by` columns + foreign keys to `admins`. Use it in every content-table
  migration (call `$this->addAuditColumns($table)` and `dropAuditColumns()` on down
  if needed). A polymorphic variant (`addMorphedAuditColumns`) exists for
  multi-actor tables.

## Notifications & email

- Outbound mail goes through **Notifications** (`app/Notifications/...`), not raw
  `Mail::` calls in controllers.
- Local mail is sent over SMTP to the **Mailtrap sandbox** — every message (reset
  links, etc.) is captured in your Mailtrap inbox instead of reaching real
  recipients. Check Mailtrap during development.

## Migrations / Factories / Seeders

- Migrations: `id`, business columns, `timestamps()`, `softDeletes()`, then
  `$this->addAuditColumns($table)` (when the table references admins). Default enum
  columns with the enum value, e.g. `->default(AdminStatus::Inactive->value)`.
- Factories: namespace `Database\Factories`, set `protected $model`, provide named
  states (e.g. `inactive()`). Cache the hashed password like `AdminFactory` does.
- Seeders: use `updateOrCreate` so re-seeding is idempotent; register new seeders in
  `DatabaseSeeder::run()` via `$this->call([...])`.
- Verify schema changes with `php artisan migrate:fresh --seed`.

## Flash messages — PHPFlasher

- We use [PHPFlasher](https://php-flasher.io/laravel/) for toast notifications.
  Assets live in `public/vendor/flasher` (run `php artisan flasher:install` after a
  fresh clone). They auto-inject into any HTML response — no blade directive needed.
- Raise notifications from controllers/services with the helper:

  ```php
  flash()->success(__($status));   // also ->error() ->warning() ->info()
  return redirect()->route('backend.dashboard');
  ```

- Use flash for **transient, page-level feedback** (saved, deleted, link sent,
  logged out). Use **field validation errors** for form problems (see below) —
  don't duplicate field errors as flashes.

## Form fields — components & per-field errors

- Per-field validation errors render via a single include:

  ```blade
  @include('backend.includes.form-feedback', ['field' => 'email'])
  ```

  It prints every message for the field (handles nested arrays for array inputs).

- Prefer the **reusable Blade components** over hand-written markup. They wrap the
  label, Lucide icon, `.admin-input` styling, error state, password toggle, and the
  `form-feedback` include automatically:

  ```blade
  <x-backend.input name="email" type="email" label="Email address" icon="mail"
                   autocomplete="username" placeholder="admin@example.com" autofocus />

  {{-- password field with a right-aligned label action + show/hide toggle --}}
  <x-backend.input name="password" type="password" label="Password" icon="lock" toggle-password>
      <x-slot:action><a href="{{ route('backend.auth.fp') }}">Forgot password?</a></x-slot:action>
  </x-backend.input>

  <x-backend.checkbox name="remember" label="Remember me" />
  <x-backend.button icon="log-in">Sign in</x-backend.button>
  ```

  - Components live in `resources/views/components/backend/` (auto-discovered as
    `<x-backend.*>`). `input` accepts `name`, `label`, `icon`, `:value`,
    `toggle-password`, an optional `action` slot, and passes any other attribute
    (`type`, `placeholder`, `autocomplete`, `required`, …) straight to the `<input>`.
  - `old()` and the `is-invalid` error class are handled inside the component.
  - Add fields by extending these components first; only drop to raw markup for
    genuinely one-off inputs.

## Views & assets

- Auth pages `@extends('backend.layouts.auth')` (split-screen brand + form). The
  future dashboard uses `backend.layouts.master`. Flash toasts inject automatically,
  so layouts don't need a flash partial.
- Styling: Tailwind utility classes in blades + shared primitives in
  `backend/main.css` (`.admin-input`, `.admin-input.no-icon`, `.admin-btn`,
  `.admin-field-icon`, color tokens like `--admin-primary`). Reuse these instead of
  re-styling inputs/buttons.
- **Lucide icons:** `<i data-lucide="name"></i>`, rendered by `createIcons` in
  `backend/main.js`. The password-visibility toggle uses `data-toggle-password="#id"`.
- Vite entries (`resources/css/backend/app.css`, `resources/js/backend/app.js`) are
  registered in `vite.config.js`. Tailwind v4 `@source` in `backend/app.css` must
  cover any new backend view directory — it already includes `views/backend` and
  `views/components/backend`.

### Asset gotchas

- A `main.js` that uses `$` must **`import $ from 'jquery'` itself** — don't rely on
  `window.$` due to ES import hoisting.
- Delete a stale `public/hot` file if you run only `php artisan serve` after a build;
  otherwise assets try to load from the stopped Vite dev server.

## Adding a new admin module (checklist)

1. Migration with audit columns (+ factory + seeder if it needs data).
2. Model with proper casts/enums; reuse traits.
3. Enum(s) for any status/type fields.
4. FormRequest(s) for validation under `Http/Requests/Backend/<Module>/`.
5. Service(s) under `Services/Backend/<Module>/` for the logic.
6. Thin controller under `Controllers/Backend/` (resourceful methods).
7. Routes in `routes/backend.php` inside the `backend.` group, behind
   `auth:admin`.
8. Views under `resources/views/backend/<module>/` extending
   `backend.layouts.master`, built from `<x-backend.*>` components; raise
   `flash()` toasts for actions and rely on `form-feedback` for field errors.
9. Rebuild assets if you added JS/CSS.
