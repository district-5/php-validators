<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\StringVersionMajorMinorPatchGTE;
use PHPUnit\Framework\TestCase;

class StringVersionMajorMinorPatchGTETest extends TestCase
{
    public function testMissingMinValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = new StringVersionMajorMinorPatchGTE();
    }

    public function testValidPatchGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertTrue($instance->isValid('1.0.1'));
    }

    public function testInvalidPatchGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertFalse($instance->isValid('0.0.99'));
    }

    public function testValidMinorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertTrue($instance->isValid('1.1.0'));
    }

    public function testInvalidMinorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertFalse($instance->isValid('0.1.0'));
    }

    public function testValidMajorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertTrue($instance->isValid('2.0.0'));
    }

    public function testInvalidMajorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '1.0.0']);

        $this->assertFalse($instance->isValid('0.0.0'));
    }

    public function testSwitchoverToMinorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '0.0.99']);

        $this->assertTrue($instance->isValid('0.1.0'));
    }

    public function testSwitchoverToMajorGTE()
    {
        $instance = new StringVersionMajorMinorPatchGTE(['min' => '0.99.0']);

        $this->assertTrue($instance->isValid('1.0.0'));
    }
}
