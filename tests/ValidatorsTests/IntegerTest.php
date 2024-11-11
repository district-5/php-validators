<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\Integer;
use PHPUnit\Framework\TestCase;

/**
 * Class IntegerTest
 * @package District5\ValidatorTests\Adapters
 */
class IntegerTest extends TestCase
{
    public function testInvalidType()
    {
        $instance = new Integer();

        $this->assertFalse($instance->isValid(5.5));
        $this->assertEquals('notInt', $instance->getLastErrorMessageKey());
    }

    public function testValidValue()
    {
        $instance = new Integer();

        $this->assertTrue($instance->isValid(5));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $instance = new Integer();

        $this->assertFalse($instance->isValid('5'));
        $this->assertEquals('notInt', $instance->getLastErrorMessageKey());
    }
}
