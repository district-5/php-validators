<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\BoolValue;
use PHPUnit\Framework\TestCase;

/**
 * Class BoolValueTest
 * @package District5\ValidatorTests\Adapters
 */
class BoolValueTest extends TestCase
{
    public function testValid()
    {
        $instance = new BoolValue();
        $this->assertTrue($instance->isValid(true));
        $this->assertTrue($instance->isValid(false));
    }

    public function testInvalid()
    {
        $instance = new BoolValue();
        $this->assertFalse($instance->isValid(1));
        $this->assertFalse($instance->isValid('1'));
        $this->assertFalse($instance->isValid(new \stdClass()));
        $this->assertFalse($instance->isValid([1]));
        $this->assertFalse($instance->isValid(['1']));
        $this->assertFalse($instance->isValid([1]));
        $this->assertFalse($instance->isValid(['1']));
    }
}

