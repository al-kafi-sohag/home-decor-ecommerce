<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\ResetPasswordRequest;
use App\Services\Backend\Auth\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function __construct(protected PasswordResetService $passwordResetService) {}

    /**
     * Show the reset password form for a given token.
     */
    public function create(Request $request, string $token): View
    {
        return view('backend.auth.reset-password', [
            'token' => $token,
            'email' => $request->string('email')->toString(),
        ]);
    }

    /**
     * Reset the admin's password.
     */
    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $status = $this->passwordResetService->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
        );

        if ($status === Password::PASSWORD_RESET) {
            flash()->success(__($status));

            return redirect()->route('backend.auth.login');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
