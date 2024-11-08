<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\Numeric;
use PHPUnit\Framework\TestCase;

/**
 * Class NumericValueTest
 * @package District5\ValidatorTests\Adapters
 */
class NumericTest extends TestCase
{
    public function testValidValue()
    {
        $instance = new Numeric();

        $this->assertTrue($instance->isValid(7));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $instance = new Numeric();

        $this->assertFalse($instance->isValid('hello'));
        $this->assertEquals('notNumeric', $instance->getLastErrorMessageKey());
    }
}
