<?php

declare(strict_types=1);

namespace Slimad\Eori\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Slimad\Eori\EoriValidator;

class Eori implements ValidationRule
{
    private bool $isValid;

    public function __construct(private readonly EoriValidator $validator) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->isValid = $this->validator->validate($value);
        if (! $this->isValid) {
            $fail(__('The :attribute must be a valid Eori number.'));
        }
    }

    public function passes(): bool
    {
        return $this->isValid;
    }
}
