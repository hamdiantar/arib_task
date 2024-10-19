<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/[a-z]/', $value) && preg_match('/[A-Z]/', $value) &&
            preg_match('/[0-9]/', $value) && preg_match('/[@$!%*#?&]/', $value);
    }

    public function message(): string
    {
        return 'The :attribute must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
    }
}
