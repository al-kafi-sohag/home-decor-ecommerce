<?php

use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend (admin panel) routes
|--------------------------------------------------------------------------
|
| All admin-facing routes live under the "admin" URL prefix and the
| "backend." route-name prefix. They use the dedicated "admin" auth guard.
|
*/

Route::prefix('admin')->name('backend.')->group(function () {

    // Guest-only authentication screens.
    Route::middleware('guest:admin')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'create')->name('auth.login');
            Route::post('login', 'store')->name('auth.login.store');
        });

        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('forgot-password', 'create')->name('auth.fp');
            Route::post('forgot-password', 'store')->name('auth.fp.email');
        });

        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('reset-password/{token}', 'create')->name('auth.rp');
            Route::post('reset-password', 'store')->name('auth.rp.store');
        });
    });

    // Authenticated admin area.
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('auth.logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Convenience redirect for the bare /admin URL.
    Route::redirect('/', '/admin/dashboard');
});
