@extends('backend.layouts.master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center">
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
            <i data-lucide="party-popper" class="h-6 w-6"></i>
        </div>
        <h2 class="text-xl font-semibold">Welcome, {{ auth('admin')->user()->name }}!</h2>
        <p class="mt-2 text-sm text-slate-500">
            You are signed in to the admin panel. The dashboard content will be built next.
        </p>
    </div>
@endsection
