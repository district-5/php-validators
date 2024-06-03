<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\ArrayOfNumbers;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrayOfNumbersTest
 * @package District5\ValidatorTests\Adapters
 */
class ArrayOfNumbersTest extends TestCase
{
    public function testNotArray()
    {
        $instance = new ArrayOfNumbers();

        $this->assertFalse($instance->isValid(5));
        $this->assertEquals('notArray', $instance->getLastErrorMessageKey());
    }

    public function testValidValues()
    {
        $instance = new ArrayOfNumbers();

        $this->assertTrue($instance->isValid([7, 9, 11]));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValues()
    {
        $instance = new ArrayOfNumbers();

        $this->assertFalse($instance->isValid([7, 'hello', 11]));
    }
}
