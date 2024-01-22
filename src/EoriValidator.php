<?php

declare(strict_types=1);

namespace Slimad\Eori;

interface EoriValidator
{
    public function validate(string $eoriNumber): bool;
}
