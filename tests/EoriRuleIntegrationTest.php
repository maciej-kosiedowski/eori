<?php

declare(strict_types=1);

use Davidvandertuijn\Eori\Validator;
use PHPUnit\Framework\TestCase;
use Slimad\Eori\EoriValidatorService;
use Slimad\Eori\Rules\Eori;

class EoriRuleIntegrationTest extends TestCase
{
    private Eori $rule;

    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new Eori(new EoriValidatorService(new Validator()));
    }

    public function testIntegrationSuccesEoriNumber(): void
    {
        self::assertTrue($this->rule->passes('vat_number', 'PL847146028300000'));
    }

    public function testIntegrationInvalidEoriNumber(): void
    {
        self::assertFalse($this->rule->passes('vat_number', 'PLInvalid'));
    }
}
