<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function (): void {
            Route::middleware('web')
                ->group(base_path('routes/backend.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Send unauthenticated admin-area requests to the admin login screen.
        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('admin') || $request->is('admin/*')
            ? route('backend.auth.login')
            : null);

        // Authenticated admins hitting a guest-only screen go to the dashboard.
        $middleware->redirectUsersTo(fn (Request $request) => $request->is('admin') || $request->is('admin/*')
            ? route('backend.dashboard')
            : null);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
