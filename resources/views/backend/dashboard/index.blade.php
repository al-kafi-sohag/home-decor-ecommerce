@extends('backend.layouts.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . (auth('admin')->user()->name ?? 'Admin') . ' — here is your store at a glance')

@php
    $toneStyles = [
        'primary' => 'background: var(--admin-primary-soft); color: var(--admin-primary-strong);',
        'info'    => 'background: var(--admin-info-soft); color: var(--admin-info);',
        'warning' => 'background: var(--admin-warning-soft); color: var(--admin-warning);',
        'success' => 'background: var(--admin-success-soft); color: var(--admin-success);',
    ];
    $statusBadge = [
        'completed'  => 'success',
        'processing' => 'info',
        'pending'    => 'warning',
        'cancelled'  => 'danger',
    ];
    $maxRevenue = max(array_column($revenue, 'value')) ?: 1;
@endphp

@section('content')
    {{-- Page header --}}
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-[var(--admin-ink)]">Store Overview</h2>
            <p class="text-sm text-[var(--admin-muted)]">{{ now()->format('l, F j, Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" class="inline-flex items-center gap-2 rounded-lg border border-[var(--admin-border)] bg-white px-3.5 py-2 text-sm font-medium text-[var(--admin-ink-soft)] transition hover:bg-[var(--admin-surface-alt)]">
                <i data-lucide="download" class="h-4 w-4"></i>
                Export
            </button>
            <button type="button" class="inline-flex items-center gap-2 rounded-lg px-3.5 py-2 text-sm font-semibold text-white transition hover:brightness-105" style="background-color: var(--admin-primary); box-shadow: 0 8px 20px -8px rgba(var(--admin-primary-rgb), 0.6);">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Add Product
            </button>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $i => $stat)
            <div class="admin-card admin-fade-up p-5" style="animation-delay: {{ $i * 70 }}ms;">
                <div class="flex items-start justify-between">
                    <span class="admin-stat-icon" style="{{ $toneStyles[$stat['tone']] ?? $toneStyles['primary'] }}">
                        <i data-lucide="{{ $stat['icon'] }}" class="h-5 w-5"></i>
                    </span>
                    <span class="admin-trend {{ $stat['trend'] >= 0 ? 'up' : 'down' }}">
                        <i data-lucide="{{ $stat['trend'] >= 0 ? 'trending-up' : 'trending-down' }}" class="h-3 w-3"></i>
                        {{ abs($stat['trend']) }}%
                    </span>
                </div>
                <p class="mt-4 text-2xl font-bold tracking-tight text-[var(--admin-ink)]">{{ $stat['value'] }}</p>
                <p class="text-sm font-medium text-[var(--admin-ink-soft)]">{{ $stat['label'] }}</p>
                <p class="mt-1 text-xs text-[var(--admin-muted)]">{{ $stat['caption'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Charts + top products --}}
    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Revenue chart --}}
        <div class="admin-card p-5 lg:col-span-2">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-[var(--admin-ink)]">Revenue Overview</h3>
                    <p class="text-xs text-[var(--admin-muted)]">Monthly revenue (in thousands)</p>
                </div>
                <div class="flex items-center gap-1.5 rounded-lg border border-[var(--admin-border)] bg-[var(--admin-surface-alt)] px-2.5 py-1.5 text-xs font-medium text-[var(--admin-muted)]">
                    <span class="h-2 w-2 rounded-full" style="background-color: var(--admin-primary);"></span>
                    This year
                </div>
            </div>

            <div class="flex h-56 items-end gap-2 sm:gap-3">
                @foreach ($revenue as $bar)
                    @php $h = max(6, round(($bar['value'] / $maxRevenue) * 100)); @endphp
                    <div class="group flex flex-1 flex-col items-center gap-2">
                        <div class="relative flex w-full flex-1 items-end">
                            <div class="w-full rounded-t-md transition-all duration-300 group-hover:opacity-100"
                                 style="height: {{ $h }}%; background: linear-gradient(180deg, var(--admin-primary), rgba(var(--admin-primary-rgb), 0.55)); opacity: 0.85;"
                                 title="{{ $bar['month'] }}: ${{ $bar['value'] }}k"></div>
                        </div>
                        <span class="text-[10px] font-medium text-[var(--admin-muted)]">{{ $bar['month'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Top products --}}
        <div class="admin-card p-5">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-base font-semibold text-[var(--admin-ink)]">Top Products</h3>
                <a href="#" class="text-xs font-semibold" style="color: var(--admin-primary-strong);">View all</a>
            </div>
            <div class="space-y-4">
                @foreach ($topProducts as $product)
                    <div>
                        <div class="mb-1.5 flex items-center justify-between gap-2">
                            <span class="truncate text-sm font-medium text-[var(--admin-ink-soft)]">{{ $product['name'] }}</span>
                            <span class="shrink-0 text-xs text-[var(--admin-muted)]">{{ $product['sold'] }} sold</span>
                        </div>
                        <div class="h-1.5 w-full overflow-hidden rounded-full bg-[var(--admin-surface-alt)]">
                            <div class="h-full rounded-full" style="width: {{ $product['share'] }}%; background-color: var(--admin-primary);"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent orders --}}
    <div class="admin-card mt-6 overflow-hidden">
        <div class="flex items-center justify-between border-b border-[var(--admin-border)] px-5 py-4">
            <div>
                <h3 class="text-base font-semibold text-[var(--admin-ink)]">Recent Orders</h3>
                <p class="text-xs text-[var(--admin-muted)]">Latest activity across your store</p>
            </div>
            <a href="#" class="inline-flex items-center gap-1.5 text-xs font-semibold" style="color: var(--admin-primary-strong);">
                View all <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left text-sm">
                <thead>
                    <tr class="border-b border-[var(--admin-border)] text-xs uppercase tracking-wide text-[var(--admin-faint)]">
                        <th class="px-5 py-3 font-semibold">Order</th>
                        <th class="px-5 py-3 font-semibold">Customer</th>
                        <th class="px-5 py-3 font-semibold">Product</th>
                        <th class="px-5 py-3 font-semibold">Total</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                        <tr class="border-b border-[var(--admin-border)] last:border-0 transition hover:bg-[var(--admin-surface-alt)]">
                            <td class="px-5 py-3.5 font-medium text-[var(--admin-ink)]">{{ $order['id'] }}</td>
                            <td class="px-5 py-3.5 text-[var(--admin-ink-soft)]">{{ $order['customer'] }}</td>
                            <td class="px-5 py-3.5 text-[var(--admin-muted)]">{{ $order['product'] }}</td>
                            <td class="px-5 py-3.5 font-semibold text-[var(--admin-ink)]">{{ $order['total'] }}</td>
                            <td class="px-5 py-3.5">
                                <span class="admin-badge {{ $statusBadge[$order['status']] ?? 'info' }}">{{ ucfirst($order['status']) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
