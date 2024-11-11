<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\IntegerRange;
use PHPUnit\Framework\TestCase;

/**
 * Class IntegerRangeTest
 * @package District5\ValidatorTests\Adapters
 */
class IntegerRangeTest extends TestCase
{
    public function testInvalidConfiguration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = new IntegerRange([]);
    }

    public function testValidValue()
    {
        $options = [
            'min' => 1,
            'max' => 10,
        ];
        $instance = new IntegerRange($options);

        $this->assertTrue($instance->isValid(7));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValueTooHigh()
    {
        $options = [
            'min' => 1,
            'max' => 10,
        ];
        $instance = new IntegerRange($options);

        $this->assertFalse($instance->isValid(11));
        $this->assertEquals('moreThan', $instance->getLastErrorMessageKey());
    }

    public function testInvalidValueTooLow()
    {
        $options = [
            'min' => 10,
            'max' => 20,
        ];
        $instance = new IntegerRange($options);

        $this->assertFalse($instance->isValid(5));
        $this->assertEquals('lessThan', $instance->getLastErrorMessageKey());
    }

    public function testInvalidValueNotInteger()
    {
        $options = [
            'min' => 10,
            'max' => 20,
        ];
        $instance = new IntegerRange($options);

        $this->assertFalse($instance->isValid(true));
    }
}
