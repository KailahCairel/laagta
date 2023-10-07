<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CurrentPasswordCheck implements Rule
{
    public function passes($attribute, $value)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the provided password matches the current user's password
        return Hash::check($value, $user->password);
    }

    public function message()
    {
        return 'The current password is incorrect.';
    }
}
