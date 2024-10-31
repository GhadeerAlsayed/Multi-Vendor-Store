<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class Filter implements ValidationRule
{
    protected $forbidden;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct($forbidden){
        $this->forbidden = $forbidden;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array(strtolower($value), array_map('strtolower', $this->forbidden))) {
            $fail("The {$attribute} must not be '{$value}'.");
        }
    }
}
