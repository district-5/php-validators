<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\NumericSpecificValues;
use PHPUnit\Framework\TestCase;

/**
 * Class NumericSpecificValuesTest
 * @package District5\ValidatorTests\Adapters
 */
class NumericSpecificValuesTest extends TestCase
{
    public function testInvalidConfiguration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = new NumericSpecificValues([]);
    }

    public function testSingleValue()
    {
        $instance = new NumericSpecificValues(['values' => [7]]);

        $this->assertTrue($instance->isValid(7));

        $this->assertFalse($instance->isValid(1));
    }

    public function testMultipleValues()
    {
        $instance = new NumericSpecificValues(['values' => [7, 9, 11]]);

        $this->assertTrue($instance->isValid(7));
        $this->assertTrue($instance->isValid(9));
        $this->assertTrue($instance->isValid(11));

        $this->assertFalse($instance->isValid(1));
    }
}
