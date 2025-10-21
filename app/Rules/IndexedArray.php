<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IndexedArray implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail(__('The :attribute must be an array.'));
            return;
        }

        foreach ($value as $key => $item) {
            if (!is_int($key)) {
                $fail(__('message.the_array_must_be_indexed'));
                return;
            }
        }
    }
}
