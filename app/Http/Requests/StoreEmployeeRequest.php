<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneValidation;
use App\Rules\StrongPassword;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'unique:users,phone', new PhoneValidation()],
            'password' => ['required', 'confirmed', 'min:8', new StrongPassword()],
            'is_manager' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'The phone number is already taken.',
        ];
    }
}
