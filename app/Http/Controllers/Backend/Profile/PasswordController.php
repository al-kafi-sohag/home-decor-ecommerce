<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\UpdatePasswordRequest;
use App\Services\Backend\Profile\ProfileService;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    public function __construct(protected ProfileService $profileService) {}

    /**
     * Update the authenticated admin's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $this->profileService->updatePassword(
            $request->user('admin'),
            $request->validated()['password'],
        );

        flash()->success('Your password has been changed.');

        return back();
    }
}
