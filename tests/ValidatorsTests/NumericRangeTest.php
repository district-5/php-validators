<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\NumericRange;
use PHPUnit\Framework\TestCase;

/**
 * Class NumericRangeTest
 * @package District5\ValidatorTests\Adapters
 */
class NumericRangeTest extends TestCase
{
    public function testValidValue()
    {
        $options = [
            'min' => 1,
            'max' => 10,
        ];
        $instance = new NumericRange($options);

        $this->assertTrue($instance->isValid(7));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValueTooHigh()
    {
        $options = [
            'min' => 1,
            'max' => 10,
        ];
        $instance = new NumericRange($options);

        $this->assertFalse($instance->isValid(11));
        $this->assertEquals('moreThan', $instance->getLastErrorMessageKey());
    }

    public function testInvalidValueTooLow()
    {
        $options = [
            'min' => 10,
            'max' => 20,
        ];
        $instance = new NumericRange($options);

        $this->assertFalse($instance->isValid(5));
        $this->assertEquals('lessThan', $instance->getLastErrorMessageKey());
    }
}
