<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\Hex;
use PHPUnit\Framework\TestCase;

/**
 * Class HexTest
 * @package District5\ValidatorTests\Adapters
 */
class HexTest extends TestCase
{
    public function testInvalidType()
    {
        $instance = new Hex();

        $this->assertFalse($instance->isValid(5.5));
        $this->assertEquals('valueIncompatibility', $instance->getLastErrorMessageKey());
    }

    public function testValidValue()
    {
        $instance = new Hex();

        $this->assertTrue($instance->isValid('0123456789abcdef'));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $instance = new Hex();

        $this->assertFalse($instance->isValid('0123456789abcdefg'));
        $this->assertEquals('notHex', $instance->getLastErrorMessageKey());
    }
}
