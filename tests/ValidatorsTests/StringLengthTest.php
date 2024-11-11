<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\StringLength;
use PHPUnit\Framework\TestCase;

/**
 * Class StringLengthTest
 * @package District5\ValidatorTests\Adapters
 */
class StringLengthTest extends TestCase
{
    public function testInvalidConfiguration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = new StringLength([]);
    }

    public function testValidExactValue()
    {
        $instance = new StringLength(['exact' => 4]);

        $this->assertTrue($instance->isValid('test'));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testValidInRangeValue()
    {
        $instance = new StringLength(['min' => 4, 'max' => 6]);

        $this->assertTrue($instance->isValid('hello'));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidExactNull()
    {
        $instance = new StringLength(['exact' => 4]);

        $this->assertFalse($instance->isValid(null));
    }

    public function testInvalidInRangeNull()
    {
        $instance = new StringLength(['min' => 4, 'max' => 6]);

        $this->assertFalse($instance->isValid(null));
    }

    public function testInvalidExactTooLongLength()
    {
        $instance = new StringLength(['exact' => 4]);

        $this->assertFalse($instance->isValid('hello'));
        $this->assertEquals('tooLong', $instance->getLastErrorMessageKey());
    }

    public function testInvalidExactTooShortLength()
    {
        $instance = new StringLength(['exact' => 4]);

        $this->assertFalse($instance->isValid('hi'));
        $this->assertEquals('tooShort', $instance->getLastErrorMessageKey());
    }

    public function testInvalidInRangeTooLongLength()
    {
        $instance = new StringLength(['min' => 4, 'max' => 6]);

        $this->assertFalse($instance->isValid('helloworld'));
        $this->assertEquals('tooLong', $instance->getLastErrorMessageKey());
    }

    public function testInvalidInRangeTooShortLength()
    {
        $instance = new StringLength(['min' => 4, 'max' => 6]);

        $this->assertFalse($instance->isValid('hi'));
        $this->assertEquals('tooShort', $instance->getLastErrorMessageKey());
    }
}
