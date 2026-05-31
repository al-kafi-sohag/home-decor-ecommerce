<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\ForgotPasswordRequest;
use App\Services\Backend\Auth\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function __construct(protected PasswordResetService $passwordResetService) {}

    /**
     * Show the "forgot password" form.
     */
    public function create(): View
    {
        return view('backend.auth.forgot-password');
    }

    /**
     * Send a password reset link to the admin's email.
     */
    public function store(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = $this->passwordResetService->sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            flash()->success(__($status));

            return back();
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
