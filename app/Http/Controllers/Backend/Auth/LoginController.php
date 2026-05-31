<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\LoginRequest;
use App\Services\Backend\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    /**
     * Show the admin login form.
     */
    public function create(): View
    {
        return view('backend.auth.login');
    }

    /**
     * Handle an admin login attempt.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->authService->login(
            $request,
            $request->only('email', 'password'),
            $request->boolean('remember'),
        );

        return redirect()->intended(route('backend.dashboard'));
    }

    /**
     * Log the admin out.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        flash()->info('You have been logged out.');

        return redirect()->route('backend.auth.login');
    }
}
