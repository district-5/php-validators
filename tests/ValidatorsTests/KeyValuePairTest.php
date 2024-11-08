<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\KeyValuePairList;
use PHPUnit\Framework\TestCase;

/**
 * Class HexTest
 * @package District5\ValidatorTests\Adapters
 */
class KeyValuePairTest extends TestCase
{
    public function testValidDefaultConfiguration()
    {
        $kvp = [
            'k1' => 1,
            'k2' => true,
            'k3' => 'hello world',
            'k4' => 4.3
        ];
        $instance = new KeyValuePairList();

        $this->assertTrue($instance->isValid($kvp));
    }

    public function testInvalidDefaultConfiguration()
    {
        $kvp = [
            'k1' => 1,
            'k2' => true,
            'k3' => 'hello world',
            'k4' => 4.3,
            'k5' => null
        ];
        $instance = new KeyValuePairList();

        $this->assertFalse($instance->isValid($kvp));
    }

    public function testAllAllowed()
    {
        $kvp = [
            'k1' => 1,
            'k2' => true,
            'k3' => 'hello world',
            'k4' => 4.3,
            'k5' => null
        ];
        $instance = new KeyValuePairList(
            true,
            true,
            true,
            true,
            true
        );

        $this->assertTrue($instance->isValid($kvp));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidBoolean()
    {
        $kvp1 = [
            'k1' => 1,
            'k3' => 'hello world',
            'k4' => 4.3,
            'k5' => null
        ];
        $kvp2 = [
            'k2' => true
        ];
        $instance = new KeyValuePairList(
            false,
            true,
            true,
            true,
            true
        );

        $this->assertTrue($instance->isValid($kvp1));
        $this->assertNull($instance->getLastErrorMessageKey());
        $this->assertFalse($instance->isValid($kvp2));
        $this->assertEquals('notValidValue', $instance->getLastErrorMessageKey());
    }

    public function testInvalidFloat()
    {
        $kvp1 = [
            'k1' => 1,
            'k2' => true,
            'k3' => 'hello world',
            'k5' => null
        ];
        $kvp2 = [
            'k4' => 4.3
        ];
        $instance = new KeyValuePairList(
            true,
            false,
            true,
            true,
            true
        );

        $this->assertTrue($instance->isValid($kvp1));
        $this->assertNull($instance->getLastErrorMessageKey());
        $this->assertFalse($instance->isValid($kvp2));
        $this->assertEquals('notValidValue', $instance->getLastErrorMessageKey());
    }

    public function testInvalidInteger()
    {
        $kvp1 = [
            'k2' => true,
            'k3' => 'hello world',
            'k4' => 4.3,
            'k5' => null
        ];
        $kvp2 = [
            'k1' => 1
        ];
        $instance = new KeyValuePairList(
            true,
            true,
            false,
            true,
            true
        );

        $this->assertTrue($instance->isValid($kvp1));
        $this->assertNull($instance->getLastErrorMessageKey());
        $this->assertFalse($instance->isValid($kvp2));
        $this->assertEquals('notValidValue', $instance->getLastErrorMessageKey());
    }

    public function testInvalidNull()
    {
        $kvp1 = [
            'k1' => 1,
            'k2' => true,
            'k3' => 'hello world',
            'k4' => 4.3
        ];
        $kvp2 = [
            'k5' => null
        ];
        $instance = new KeyValuePairList(
            true,
            true,
            true,
            false,
            true
        );

        $this->assertTrue($instance->isValid($kvp1));
        $this->assertNull($instance->getLastErrorMessageKey());
        $this->assertFalse($instance->isValid($kvp2));
        $this->assertEquals('notValidValue', $instance->getLastErrorMessageKey());
    }

    public function testInvalidString()
    {
        $kvp1 = [
            'k1' => 1,
            'k2' => true,
            'k4' => 4.3,
            'k5' => null
        ];
        $kvp2 = [
            'k3' => 'hello world',
        ];
        $instance = new KeyValuePairList(
            true,
            true,
            true,
            true,
            false
        );

        $this->assertTrue($instance->isValid($kvp1));
        $this->assertNull($instance->getLastErrorMessageKey());
        $this->assertFalse($instance->isValid($kvp2));
        $this->assertEquals('notValidValue', $instance->getLastErrorMessageKey());
    }
}
