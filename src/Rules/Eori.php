<?php

declare(strict_types=1);

namespace Slimad\Eori\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Slimad\Eori\EoriValidator;

class Eori implements ValidationRule
{
    public function __construct(private readonly EoriValidator $validator) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->validator->validate($value)) {
            $fail(__('The :attribute must be a valid Eori number.'));
        }
    }
}
