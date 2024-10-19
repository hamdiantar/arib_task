<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'image' => 'nullable|image',
            'manager_id' => 'nullable|exists:employees,id',
            'department_id' => 'nullable|exists:departments,id',
            'email' => 'required|email|unique:users,email,' . $this->employee,
            'phone' => ['required', 'unique:users,phone,' . $this->employee, 'regex:/^(011|010|015)[0-9]{8}$/'],
            'password' => $this->isMethod('POST') ? 'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/' : 'nullable|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number must start with 011, 010, or 015 followed by 8 digits.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ];
    }
}
