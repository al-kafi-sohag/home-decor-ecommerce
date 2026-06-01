@extends('backend.layouts.master')

@section('title', 'Profile')
@section('page-title', 'Profile')
@section('page-subtitle', 'Manage your personal information and account security')

@php
    // Map the AdminStatus colour token onto our badge variants.
    $statusVariant = [
        'emerald' => 'success',
        'amber' => 'warning',
        'rose' => 'danger',
    ][$admin->status->color()] ?? 'info';
@endphp

@section('content')
    <section class="mx-auto w-full max-w-7xl admin-fade-up">
        {{-- Header --}}
        <div class="mb-6 flex items-start justify-between gap-4">
            <div>
                <p class="inline-flex rounded-full border px-3 py-1 font-mono text-[11px] font-medium tracking-[0.12em]"
                   style="border-color: var(--admin-primary-soft); background: var(--admin-primary-soft); color: var(--admin-primary-strong);">
                    PROFILE SETTINGS
                </p>
                <h2 class="mt-3 text-2xl font-semibold text-[var(--admin-ink)]">Profile Management</h2>
                <p class="mt-1 text-sm text-[var(--admin-muted)]">Update your basic profile information and password securely.</p>
            </div>

            <span class="admin-badge {{ $statusVariant }} shrink-0">{{ $admin->status->label() }}</span>
        </div>

        <div class="grid gap-5 xl:grid-cols-[2fr_0.8fr]">
            {{-- Forms --}}
            <div class="space-y-5">
                {{-- Manage profile --}}
                <form method="POST" action="{{ route('backend.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <x-backend.card title="Manage Profile" subtitle="Your photo, name and contact details.">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <x-backend.image-uploader
                                    name="avatar"
                                    label="Profile Photo"
                                    :value="$admin->avatarUrl()"
                                    :aspect-ratio="1"
                                    circle
                                    hint="Square image works best. JPG, PNG or WebP up to 5 MB." />
                            </div>

                            <div class="sm:col-span-2">
                                <x-backend.input name="email" type="email" label="Email"
                                    :value="$admin->email" placeholder="name@example.com" required />
                            </div>

                            <x-backend.input name="name" label="Name"
                                :value="$admin->name" placeholder="Enter your full name" required />

                            <x-backend.input name="designation" label="Designation"
                                :value="$admin->designation" placeholder="Enter your designation" />

                            <x-backend.input name="phone" label="Phone"
                                :value="$admin->phone" placeholder="+1 555 000 0000" />

                            <div class="sm:col-span-2">
                                <x-backend.textarea name="bio" label="Bio" :value="$admin->bio" rows="3"
                                    placeholder="A short description about you (optional)." />
                            </div>
                        </div>

                        <x-slot:footer>
                            <button type="submit"
                                class="rounded-full border px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.08em] text-white transition hover:brightness-105"
                                style="border-color: var(--admin-primary); background: var(--admin-primary);">
                                Update Profile
                            </button>
                        </x-slot:footer>
                    </x-backend.card>
                </form>

                {{-- Update password --}}
                <form method="POST" action="{{ route('backend.profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <x-backend.card title="Update Password" subtitle="Use a strong, unique password.">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <x-backend.input name="current_password" type="password" label="Previous Password"
                                    autocomplete="current-password"
                                    placeholder="Enter previous password" toggle-password />
                            </div>

                            <x-backend.input name="password" type="password" label="New Password"
                                autocomplete="new-password"
                                placeholder="Enter new password" toggle-password />

                            <x-backend.input name="password_confirmation" type="password" label="Retype New Password"
                                autocomplete="new-password"
                                placeholder="Retype new password" toggle-password />
                        </div>

                        <x-slot:footer>
                            <button type="submit"
                                class="rounded-full border px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.08em] text-white transition hover:brightness-105"
                                style="border-color: var(--admin-primary); background: var(--admin-primary);">
                                Update Password
                            </button>
                        </x-slot:footer>
                    </x-backend.card>
                </form>
            </div>

            {{-- Documentation (auto-hides on smaller screens) --}}
            <aside class="hidden xl:block">
                <x-backend.card title="Documentation">
                    <div class="space-y-3 text-sm">
                        @php
                            $docs = [
                                ['Profile Photo', 'Optional. Upload a square image; crop it in the popup before it is saved. JPG, PNG or WebP up to 5 MB.'],
                                ['Email', 'Required and must be unique. This email is used to sign in.'],
                                ['Name', 'Required. Use your full official name as shown in records.'],
                                ['Designation', 'Optional. Your current office role or title for identification.'],
                                ['Phone', 'Optional. A reachable contact number.'],
                                ['Bio', 'Optional. A short description shown on your profile (max 1000 characters).'],
                                ['Previous Password', 'Required to change the password. Must match your current password.'],
                                ['New Password', 'Use a strong password with letters, numbers and symbols.'],
                                ['Retype New Password', 'Must exactly match the new password to confirm the change.'],
                            ];
                        @endphp

                        @foreach ($docs as [$term, $desc])
                            <div class="rounded-lg border border-[var(--admin-border)] bg-[var(--admin-surface-alt)] p-3">
                                <p class="font-semibold text-[var(--admin-ink)]">{{ $term }}</p>
                                <p class="mt-1 text-[var(--admin-muted)]">{{ $desc }}</p>
                            </div>
                        @endforeach
                    </div>
                </x-backend.card>
            </aside>
        </div>
    </section>
@endsection
