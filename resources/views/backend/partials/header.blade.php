{{-- Admin top bar: sidebar toggle, page heading, quick search + user menu. --}}
@php
    $admin = auth('admin')->user();
@endphp

<header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-[var(--admin-border)] bg-[var(--admin-surface)]/95 px-4 backdrop-blur-sm sm:px-6">
    <div class="flex min-w-0 items-center gap-3">
        <button type="button" data-sidebar-toggle
            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-[var(--admin-border)] text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]"
            aria-label="Toggle sidebar">
            <i data-lucide="panel-left" class="h-4.5 w-4.5"></i>
        </button>

        <div class="min-w-0">
            <h1 class="truncate text-base font-semibold text-[var(--admin-ink)]">@yield('page-title', 'Dashboard')</h1>
            <p class="hidden truncate text-[11px] text-[var(--admin-muted)] sm:block">@yield('page-subtitle', 'Welcome back to your store overview')</p>
        </div>
    </div>

    <div class="flex items-center gap-2 sm:gap-3">
        {{-- Search (decorative for now) --}}
        <div class="relative hidden md:block">
            <i data-lucide="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[var(--admin-faint)]"></i>
            <input type="text" placeholder="Search…"
                class="w-56 rounded-lg border border-[var(--admin-border)] bg-[var(--admin-surface-alt)] py-2 pl-9 pr-3 text-sm text-[var(--admin-ink)] outline-none transition focus:border-[var(--admin-primary)] focus:bg-white">
        </div>

        <button type="button"
            class="relative inline-flex h-9 w-9 items-center justify-center rounded-lg border border-[var(--admin-border)] text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]"
            aria-label="Notifications">
            <i data-lucide="bell" class="h-4.5 w-4.5"></i>
            <span class="absolute right-2 top-2 h-2 w-2 rounded-full ring-2 ring-white" style="background-color: var(--admin-primary);"></span>
        </button>

        {{-- User menu --}}
        <div class="relative" data-dropdown>
            <button type="button" data-dropdown-toggle
                class="flex items-center gap-2.5 rounded-full border border-[var(--admin-border)] bg-[var(--admin-surface-alt)] py-1 pl-1 pr-2.5 transition hover:bg-white">
                <x-backend.avatar :user="$admin" :size="32" />
                <span class="hidden text-right leading-tight sm:block">
                    <span class="block text-xs font-semibold text-[var(--admin-ink)]">{{ $admin->name ?? 'Admin' }}</span>
                    <span class="block text-[11px] text-[var(--admin-muted)]">Administrator</span>
                </span>
                <i data-lucide="chevron-down" class="hidden h-4 w-4 text-[var(--admin-faint)] sm:block"></i>
            </button>

            <div data-dropdown-menu
                class="absolute right-0 mt-2 hidden w-52 overflow-hidden rounded-xl border border-[var(--admin-border)] bg-white shadow-[var(--admin-shadow-panel)]">
                <div class="border-b border-[var(--admin-border)] px-4 py-3">
                    <p class="truncate text-sm font-semibold text-[var(--admin-ink)]">{{ $admin->name ?? 'Admin' }}</p>
                    <p class="truncate text-[11px] text-[var(--admin-muted)]">{{ $admin->email ?? '' }}</p>
                </div>
                <div class="py-1.5 text-sm">
                    <a href="{{ route('backend.profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]">
                        <i data-lucide="user" class="h-4 w-4 text-[var(--admin-muted)]"></i> Profile
                    </a>
                    <a href="#" class="flex items-center gap-2.5 px-4 py-2 text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]">
                        <i data-lucide="settings" class="h-4 w-4 text-[var(--admin-muted)]"></i> Settings
                    </a>
                </div>
                <form method="POST" action="{{ route('backend.auth.logout') }}" class="border-t border-[var(--admin-border)]">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-[var(--admin-danger)] transition hover:bg-[var(--admin-danger-soft)]">
                        <i data-lucide="log-out" class="h-4 w-4"></i> Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
