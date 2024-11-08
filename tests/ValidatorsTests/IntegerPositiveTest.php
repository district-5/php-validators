<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\IntegerPositive;
use PHPUnit\Framework\TestCase;

/**
 * Class IntegerPositiveTest
 * @package District5\ValidatorTests\Adapters
 */
class IntegerPositiveTest extends TestCase
{
    public function testValidValue()
    {
        $instance = new IntegerPositive();

        $this->assertTrue($instance->isValid(7));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $instance = new IntegerPositive();

        $this->assertFalse($instance->isValid(-5));
        $this->assertEquals('notPositive', $instance->getLastErrorMessageKey());
    }

    public function testInvalidValueNotInteger()
    {
        $instance = new IntegerPositive();

        $this->assertFalse($instance->isValid(true));
    }
}
