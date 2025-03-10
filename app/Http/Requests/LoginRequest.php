<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => __('auth.login_required'),
            'password.required' => __('auth.password_required'),
        ];
    }
}
