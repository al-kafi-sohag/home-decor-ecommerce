# Agent Instructions

This folder holds working instructions for AI agents (and humans) contributing to
the **Indecor** home-decor e-commerce app. Read the relevant file before making
changes so the codebase stays consistent as it grows.

| Area | File | Scope |
| --- | --- | --- |
| Storefront | [`frontend.md`](./frontend.md) | Public site under `resources/views/frontend`, `Frontend\*` controllers, frontend assets |
| Admin panel | [`backend.md`](./backend.md) | Admin area under `/admin`, `Backend\*` controllers, auth, backend assets |

## Project at a glance

- **Framework:** Laravel 13 (PHP 8.3)
- **Database:** MySQL (see `.env` → `DB_CONNECTION=mysql`, db `home_decor_ecommerce`).
  The MySQL server must be running and the database created before migrating.
- **Mail:** SMTP via **Mailtrap sandbox** in local — outbound mail lands in your
  Mailtrap inbox (not the real recipient). Check there for reset links etc.
- **Build:** Vite + Tailwind CSS v4 (`@tailwindcss/vite`), jQuery, Lucide icons
- **Frontend / backend split:** every layer (views, controllers, css, js) is
  namespaced into `frontend` and `backend` so the two surfaces never bleed into
  each other.

## Golden rules

1. Keep the **frontend/backend separation** in every layer you touch.
2. **Thin controllers** — validation lives in FormRequests, business logic in
   Services. Controllers only orchestrate and return a response.
3. Prefer **Enums** over magic numbers/strings, **Traits** for reusable schema or
   model behavior, and **Notifications** for outbound messages.
4. Don't hardcode values that will later come from the database (theme colors,
   product data, etc.) — shape them so the swap is painless.
5. Run `npm run build` (or keep `npm run dev` running) after touching assets.
