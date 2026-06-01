<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\UpdateProfileRequest;
use App\Services\Backend\Profile\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService) {}

    /**
     * Show the authenticated admin's profile screen.
     */
    public function edit(): View
    {
        return view('backend.profile.edit', [
            'admin' => auth('admin')->user(),
        ]);
    }

    /**
     * Update the authenticated admin's profile details.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->profileService->update($request->user('admin'), $request->validated());

        flash()->success('Your profile has been updated.');

        return back();
    }
}
