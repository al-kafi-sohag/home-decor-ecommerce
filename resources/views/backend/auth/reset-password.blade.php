@extends('backend.layouts.auth')

@section('title', 'Reset Password')
@section('heading', 'Reset your password')
@section('subheading', 'Choose a new password for your account.')

@section('content')
    <form method="POST" action="{{ route('backend.auth.rp.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <x-backend.input
            name="email"
            type="email"
            label="Email address"
            icon="mail"
            :value="$email"
            autocomplete="username"
            placeholder="admin@example.com" />

        <x-backend.input
            name="password"
            type="password"
            label="New password"
            icon="lock"
            autocomplete="new-password"
            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
            toggle-password />

        <x-backend.input
            name="password_confirmation"
            type="password"
            label="Confirm new password"
            icon="lock"
            autocomplete="new-password"
            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
            toggle-password />

        <x-backend.button icon="key-round">Reset password</x-backend.button>
    </form>
@endsection
