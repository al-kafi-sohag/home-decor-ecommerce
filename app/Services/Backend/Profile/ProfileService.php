<?php

namespace App\Services\Backend\Profile;

use App\Models\Admin;
use App\Services\Backend\Media\MediaUploadService;

class ProfileService
{
    public function __construct(protected MediaUploadService $mediaUploadService) {}

    /**
     * Update the admin's profile details and apply any avatar change made
     * through the reusable AJAX uploader.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Admin $admin, array $data): Admin
    {
        $avatarToken = $data['avatar_token'] ?? null;
        $removeAvatar = (bool) ($data['avatar_remove'] ?? false);

        unset($data['avatar_token'], $data['avatar_remove']);

        $admin->fill($data);

        // Changing the email invalidates the previous verification.
        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        $admin->save();

        if ($removeAvatar) {
            $admin->clearMediaCollection(Admin::AVATAR_COLLECTION);
        }

        if ($avatarToken) {
            // singleFile() collection automatically replaces the old image.
            $this->mediaUploadService->attachToModel($admin, Admin::AVATAR_COLLECTION, $avatarToken);
        }

        return $admin;
    }

    /**
     * Replace the admin's password. The model's "hashed" cast handles hashing.
     */
    public function updatePassword(Admin $admin, string $password): void
    {
        $admin->forceFill(['password' => $password])->save();
    }
}
