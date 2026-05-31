<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
        return [
            'email' => ['required', 'string', 'email', 'exists:admins,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'We could not find an admin with that email address.',
        ];
    }
}
