<?php

declare(strict_types=1);

namespace Slimad\Tests;

use Exception;
use Mockery\MockInterface;
use Slimad\Eori\EoriValidator;
use Slimad\Eori\Rules\Eori;

class EoriRuleTest extends EoriTestCase
{
    private Eori $rule;

    private EoriValidator|MockInterface $eoriValidator;

    public function setUp(): void
    {
        parent::setUp();
        $this->eoriValidator = \Mockery::mock(EoriValidator::class);
        $this->rule = new Eori($this->eoriValidator);
    }

    public function testSuccessEoriNumber(): void
    {
        $this->eoriValidator->shouldReceive('validate')->with('PL847146028300000')->andReturn(true)->once();
        $this->rule->validate('vat_number', 'PL847146028300000', function (): never {
            $this->fail('Validation should not fail');
        });
    }

    public function testInvalidEoriNumber(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The :attribute must be a valid Eori number.');
        $this->eoriValidator->shouldReceive('validate')->with('PLInvalid')->andReturn(false)->once();
        $this->rule->validate('vat_number', 'PLInvalid', static function ($message): never {
            throw new Exception($message);
        });
    }
}
