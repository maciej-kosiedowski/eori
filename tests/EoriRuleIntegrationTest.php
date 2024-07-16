<?php

declare(strict_types=1);

namespace Slimad\Tests;

use Exception;
use Slimad\Eori\Eori\Validator;
use Slimad\Eori\EoriValidatorService;
use Slimad\Eori\Rules\Eori;

class EoriRuleIntegrationTest extends EoriTestCase
{
    private Eori $rule;

    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new Eori(new EoriValidatorService(new Validator()));
    }

    public function testIntegrationSuccessEoriNumber(): void
    {
        $this->rule->validate('vat_number', 'PL847146028300000', function (): never {
            $this->fail('Validation should not fail');
        });
        $this->assertTrue(true);
    }

    public function testIntegrationInvalidEoriNumber(): void
    {
        $this->expectException(Exception::class);
        $this->rule->validate('vat_number', 'PLInvalid', static function ($message): never {
            throw new Exception($message);
        });
    }
}
