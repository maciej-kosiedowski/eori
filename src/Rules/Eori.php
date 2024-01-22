<?php

declare(strict_types=1);

namespace Slimad\Eori\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Slimad\Eori\EoriValidator;

class Eori implements Rule
{
    public function __construct(private readonly EoriValidator $validator)
    {
    }

    /**
     * @throws Exception
     */
    public function passes($attribute, $value): bool
    {
        return $this->validator->validate($value);
    }

    public function message(): string
    {
        return 'The :attribute must be a valid Eori number.';
    }
}
