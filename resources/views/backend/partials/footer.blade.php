{{-- Admin footer. --}}
<footer class="mt-auto flex flex-col items-center justify-between gap-2 border-t border-[var(--admin-border)] px-4 py-4 text-center sm:flex-row sm:px-6 sm:text-left">
    <p class="text-xs text-[var(--admin-muted)]">
        &copy; {{ date('Y') }} <span class="font-semibold text-[var(--admin-ink-soft)]">{{ config('app.name', 'Indecor') }}</span>. All rights reserved.
    </p>
    <div class="flex items-center gap-4 text-xs text-[var(--admin-muted)]">
        <a href="#" class="transition hover:text-[var(--admin-primary-strong)]">Documentation</a>
        <a href="#" class="transition hover:text-[var(--admin-primary-strong)]">Support</a>
        <span class="text-[var(--admin-faint)]">v1.0.0</span>
    </div>
</footer>
