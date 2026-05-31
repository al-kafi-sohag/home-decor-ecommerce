<?php

namespace App\Services\Backend\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetService
{
    /**
     * The password broker dedicated to admins (config/auth.php).
     */
    protected const BROKER = 'admins';

    /**
     * Send a reset link to the given admin email.
     *
     * @param  array{email: string}  $credentials
     */
    public function sendResetLink(array $credentials): string
    {
        return Password::broker(self::BROKER)->sendResetLink($credentials);
    }

    /**
     * Reset the admin's password using a valid token.
     *
     * @param  array{email: string, password: string, password_confirmation: string, token: string}  $credentials
     */
    public function reset(array $credentials): string
    {
        return Password::broker(self::BROKER)->reset(
            $credentials,
            function (CanResetPassword $admin, string $password) {
                $admin->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($admin));
            },
        );
    }
}
