<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\UnixTimestampSeconds;
use PHPUnit\Framework\TestCase;

/**
 * Class UnixTimestampSecondsTest
 * @package District5\ValidatorTests\Adapters
 */
class UnixTimestampSecondsTest extends TestCase
{
    public function testValidValue()
    {
        $instance = new UnixTimestampSeconds();

        $this->assertTrue($instance->isValid(7));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testInvalidValue()
    {
        $instance = new UnixTimestampSeconds();

        $this->assertFalse($instance->isValid(-5));
    }

    public function testInvalidValueNotInteger()
    {
        $instance = new UnixTimestampSeconds();

        $this->assertFalse($instance->isValid(true));
    }
}
