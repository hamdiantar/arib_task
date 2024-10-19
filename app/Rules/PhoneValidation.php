<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneValidation implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^(011|010|015)[0-9]{8}$/', $value);
    }

    public function message(): string
    {
        return 'The :attribute must start with 011, 010, or 015 followed by 8 digits.';
    }
}
