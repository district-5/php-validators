<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\JSONString;
use PHPUnit\Framework\TestCase;

/**
 * Class JSONStringTest
 * @package District5\ValidatorTests\Adapters
 */
class JSONStringTest extends TestCase
{
    public function testInvalidType()
    {
        $instance = new JSONString();

        $this->assertFalse($instance->isValid(null));
    }

    public function testEmptyString()
    {
        $instance = new JSONString();

        $this->assertFalse($instance->isValid(""));
    }

    public function testEmptyStringWithWhitespace()
    {
        $instance = new JSONString();

        $this->assertFalse($instance->isValid("      "));
    }

    public function testValidValue()
    {
        $json = '{"name":"District5"}';
        $instance = new JSONString();

        $this->assertTrue($instance->isValid($json));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $json = '{"name":"District5"';
        $instance = new JSONString();

        $this->assertFalse($instance->isValid($json));
    }
}
