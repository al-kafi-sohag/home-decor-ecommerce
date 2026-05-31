@extends('backend.layouts.auth')

@section('title', 'Login')
@section('heading', 'Welcome back')
@section('subheading', 'Sign in to manage your store.')

@section('content')
    <form method="POST" action="{{ route('backend.auth.login.store') }}" class="space-y-5">
        @csrf

        <x-backend.input
            name="email"
            type="email"
            label="Email address"
            icon="mail"
            autocomplete="username"
            placeholder="admin@example.com"
            autofocus />

        <x-backend.input
            name="password"
            type="password"
            label="Password"
            icon="lock"
            autocomplete="current-password"
            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
            toggle-password>
            <x-slot:action>
                <a href="{{ route('backend.auth.fp') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Forgot password?
                </a>
            </x-slot:action>
        </x-backend.input>

        <x-backend.checkbox name="remember" label="Remember me" />

        <x-backend.button icon="log-in">Sign in</x-backend.button>
    </form>
@endsection
