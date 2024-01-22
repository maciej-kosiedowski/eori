<?php

declare(strict_types=1);

namespace Slimad\Eori;

use Davidvandertuijn\Eori\Validator;
use Exception;

class EoriValidatorService implements EoriValidator
{
    public function __construct(private readonly Validator $eoriValidator)
    {
    }

    /**
     * @throws Exception
     */
    public function validate(string $eoriNumber): bool
    {
        return $this->eoriValidator->validate($eoriNumber);
    }
}
