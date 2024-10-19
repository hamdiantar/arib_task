<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneValidation;
use App\Rules\StrongPassword;

class UpdateEmployeeRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . optional($this->employee->user)->id,
            'phone' => ['required', 'unique:users,phone,' . optional($this->employee->user)->id, new PhoneValidation()],
            'password' => ['nullable', 'confirmed', 'min:8', new StrongPassword()],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'The phone number is already taken.',
        ];
    }
}
