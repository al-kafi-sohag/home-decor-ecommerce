<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:4'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email address',
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'We could not find an admin with that email address.',
        ];
    }
}
