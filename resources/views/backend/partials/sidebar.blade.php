{{--
    Admin sidebar navigation.

    Only the Dashboard route exists today; the remaining items point to "#"
    as placeholders and are wired up as the panel grows. Active state is
    resolved from the current route name so groups open automatically.
--}}
@php
    $isDashboard = request()->routeIs('backend.dashboard');
    $isProfile = request()->routeIs('backend.profile.*');
@endphp

<aside class="admin-sidebar shrink-0 border-r border-[var(--admin-border)] bg-[var(--admin-surface)]">
    <div class="flex h-full flex-col">
        {{-- Brand --}}
        <div class="flex h-16 items-center gap-2.5 border-b border-[var(--admin-border)] px-5">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl text-white"
                  style="background-color: var(--admin-primary);">
                <i data-lucide="sofa" class="h-5 w-5"></i>
            </span>
            <div class="leading-tight">
                <p class="text-sm font-bold tracking-tight text-[var(--admin-ink)]">{{ config('app.name', 'Indecor') }}</p>
                <p class="text-[11px] text-[var(--admin-muted)]">Admin Panel</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="admin-scroll flex-1 overflow-y-auto px-3 py-4">
            <a href="{{ route('backend.dashboard') }}" class="admin-nav-link {{ $isDashboard ? 'is-active' : '' }}">
                <span class="admin-nav-icon"><i data-lucide="layout-dashboard" class="h-4 w-4"></i></span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('backend.profile.edit') }}" class="admin-nav-link {{ $isProfile ? 'is-active' : '' }}">
                <span class="admin-nav-icon"><i data-lucide="user" class="h-4 w-4"></i></span>
                <span>Profile</span>
            </a>

            <p class="admin-nav-heading">Catalog</p>

            <details class="group" open>
                <summary class="admin-nav-link list-none">
                    <span class="admin-nav-icon"><i data-lucide="package" class="h-4 w-4"></i></span>
                    <span>Products</span>
                    <i data-lucide="chevron-down" class="admin-nav-chevron"></i>
                </summary>
                <div class="admin-nav-sub">
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>All Products</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Add Product</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Inventory</a>
                </div>
            </details>

            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="layout-grid" class="h-4 w-4"></i></span>
                <span>Categories</span>
            </a>
            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="layers" class="h-4 w-4"></i></span>
                <span>Collections</span>
            </a>

            <p class="admin-nav-heading">Sales</p>

            <details class="group">
                <summary class="admin-nav-link list-none">
                    <span class="admin-nav-icon"><i data-lucide="shopping-bag" class="h-4 w-4"></i></span>
                    <span>Orders</span>
                    <i data-lucide="chevron-down" class="admin-nav-chevron"></i>
                </summary>
                <div class="admin-nav-sub">
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>All Orders</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Pending</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Completed</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Refunds</a>
                </div>
            </details>

            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="users" class="h-4 w-4"></i></span>
                <span>Customers</span>
            </a>
            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="ticket-percent" class="h-4 w-4"></i></span>
                <span>Discounts</span>
            </a>

            <p class="admin-nav-heading">Insights</p>

            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="bar-chart-3" class="h-4 w-4"></i></span>
                <span>Reports</span>
            </a>
            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon"><i data-lucide="star" class="h-4 w-4"></i></span>
                <span>Reviews</span>
            </a>

            <p class="admin-nav-heading">System</p>

            <details class="group">
                <summary class="admin-nav-link list-none">
                    <span class="admin-nav-icon"><i data-lucide="settings" class="h-4 w-4"></i></span>
                    <span>Settings</span>
                    <i data-lucide="chevron-down" class="admin-nav-chevron"></i>
                </summary>
                <div class="admin-nav-sub">
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Store Profile</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Appearance</a>
                    <a href="#" class="admin-nav-sublink"><span class="dot"></span>Administrators</a>
                </div>
            </details>
        </nav>

        {{-- Footer help card --}}
        <div class="border-t border-[var(--admin-border)] p-3">
            <div class="rounded-xl p-3" style="background-color: var(--admin-primary-soft);">
                <div class="flex items-center gap-2">
                    <i data-lucide="life-buoy" class="h-4 w-4" style="color: var(--admin-primary-strong);"></i>
                    <p class="text-xs font-semibold" style="color: var(--admin-primary-strong);">Need a hand?</p>
                </div>
                <p class="mt-1 text-[11px] leading-snug text-[var(--admin-muted)]">Check the docs or reach support anytime.</p>
            </div>
        </div>
    </div>
</aside>

<div class="admin-sidebar-backdrop" data-sidebar-close></div>
