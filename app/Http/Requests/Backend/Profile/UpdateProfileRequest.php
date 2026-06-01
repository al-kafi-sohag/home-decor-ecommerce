<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $adminId = $this->user('admin')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('admins', 'email')->ignore($adminId)->whereNull('deleted_at'),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'designation' => ['nullable', 'string', 'max:120'],
            'bio' => ['nullable', 'string', 'max:1000'],

            // Avatar is handled by the reusable AJAX uploader: a temporary
            // token (uuid) to attach, plus a flag to remove the current image.
            'avatar_token' => ['nullable', 'uuid'],
            'avatar_remove' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email address',
        ];
    }
}
