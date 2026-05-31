<?php

namespace App\Services\Backend\Auth;

use App\Enums\AdminStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Attempt to authenticate an admin and start their session.
     *
     * @param  array{email: string, password: string}  $credentials
     *
     * @throws ValidationException
     */
    public function login(Request $request, array $credentials, bool $remember = false): void
    {
        if (! Auth::guard('admin')->attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $admin = Auth::guard('admin')->user();

        if (! $admin->status->canLogin()) {
            Auth::guard('admin')->logout();

            throw ValidationException::withMessages([
                'email' => 'Your account is '.$admin->status->label().'. Please contact an administrator.',
            ]);
        }

        $request->session()->regenerate();
    }

    /**
     * Log the current admin out and invalidate the session.
     */
    public function logout(Request $request): void
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
