<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\SubDomain;
use PHPUnit\Framework\TestCase;

/**
 * Class SubDomainTest
 * @package District5\ValidatorTests\Adapters
 */
class SubDomainTest extends TestCase
{
    public function testValidSingleLevelValue()
    {
        $instance = new SubDomain(true);

        $this->assertTrue($instance->isValid("test"));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidTooLongSingleLevelValue()
    {
        $instance = new SubDomain(true);

        $this->assertFalse($instance->isValid("testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttest"));
        $this->assertEquals('patternMismatch', $instance->getLastErrorMessageKey());
    }

    public function testValidMultiLevelValue()
    {
        $instance = new SubDomain(false);

        $this->assertTrue($instance->isValid("test.example.com"));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidTooShortFinalPartMultiLevelValue()
    {
        $instance = new SubDomain(false);

        $this->assertFalse($instance->isValid("test.example.c"));
        $this->assertEquals('patternMismatch', $instance->getLastErrorMessageKey());
    }
}
