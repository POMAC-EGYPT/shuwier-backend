<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $local = explode('@', $value)[0];
        if (!preg_match('/^[A-Za-z0-9._%+-]+$/', $local)) {
            $fail(__('message.invalid_email_format'));
        }
    }
}
