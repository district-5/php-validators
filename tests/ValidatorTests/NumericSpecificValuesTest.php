<?php

namespace District5\ValidatorTests;

use District5\Validator\NumericSpecificValues;
use PHPUnit\Framework\TestCase;

/**
 * Class NumericSpecificValuesTest
 * @package District5\ValidatorTests\Adapters
 */
class NumericSpecificValuesTest extends TestCase
{
    public function testSingleValue()
    {
        $instance = new NumericSpecificValues(array('values' => [7]));

        $this->assertTrue($instance->isValid(7));

        $this->assertFalse($instance->isValid(1));
    }

    public function testMultipleValues()
    {
        $instance = new NumericSpecificValues(array('values' => [7, 9, 11]));

        $this->assertTrue($instance->isValid(7));
        $this->assertTrue($instance->isValid(9));
        $this->assertTrue($instance->isValid(11));

        $this->assertFalse($instance->isValid(1));
    }
}

