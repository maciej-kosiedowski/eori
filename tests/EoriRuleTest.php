<?php

declare(strict_types=1);

namespace Slimad\Tests;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Slimad\Eori\EoriValidator;
use Slimad\Eori\Rules\Eori;

class EoriRuleTest extends TestCase
{
    private Eori $rule;

    private EoriValidator|MockInterface $eoriValidator;

    public function setUp(): void
    {
        parent::setUp();
        $this->eoriValidator = \Mockery::mock(EoriValidator::class);
        $this->rule = new Eori($this->eoriValidator);
    }

    public function testSuccesEoriNumber(): void
    {
        $this->eoriValidator->shouldReceive('validate')->with('PL847146028300000')->andReturn(true)->once();
        self::assertTrue($this->rule->passes('vat_number', 'PL847146028300000'));
    }

    public function testInvalidEoriNumber(): void
    {
        $this->eoriValidator->shouldReceive('validate')->with('PLInvalid')->andReturn(false)->once();
        self::assertFalse($this->rule->passes('vat_number', 'PLInvalid'));
    }

    public function testSuccessVatNumberMessage(): void
    {
        $this->eoriValidator->shouldReceive('validate')->with('PLInvalid')->andReturn(false)->once();
        self::assertStringContainsString('The :attribute must be a valid Eori number.', $this->rule->message());
    }
}
