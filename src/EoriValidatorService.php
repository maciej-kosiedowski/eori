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
        $this->eoriValidator->setStrict(env('EORI_VALIDATION_STRICT_MODE', false));
        return $this->eoriValidator->validate($eoriNumber);
    }
}
