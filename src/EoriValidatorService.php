<?php

declare(strict_types=1);

namespace Slimad\Eori;

use Exception;
use Slimad\Eori\Eori\Validator;

final readonly class EoriValidatorService implements EoriValidator
{
    public function __construct(private Validator $eoriValidator) {}

    /**
     * @throws Exception
     */
    public function validate(string $eoriNumber): bool
    {

        $this->eoriValidator->setStrict(config('eori.strict_mode', false));

        return $this->eoriValidator->validate($eoriNumber);
    }
}
