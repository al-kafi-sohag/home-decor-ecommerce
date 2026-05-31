@extends('backend.layouts.auth')

@section('title', 'Forgot Password')
@section('heading', 'Forgot your password?')
@section('subheading', 'Enter your email and we will send you a reset link.')

@section('content')
    <form method="POST" action="{{ route('backend.auth.fp.email') }}" class="space-y-5">
        @csrf

        <x-backend.input
            name="email"
            type="email"
            label="Email address"
            icon="mail"
            autocomplete="username"
            placeholder="admin@example.com"
            autofocus />

        <x-backend.button icon="send">Email password reset link</x-backend.button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        <a href="{{ route('backend.auth.login') }}" class="inline-flex items-center gap-1 font-medium text-indigo-600 hover:text-indigo-500">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Back to login
        </a>
    </p>
@endsection
