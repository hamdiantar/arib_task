<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use App\Rules\PhoneValidation;
use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'employee_id' => 'required|exists:employees,id',
        ];
    }
}
