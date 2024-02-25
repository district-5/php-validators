<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\DateYYYYMMDD as DateYYYYMMDDValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class BoolValueTest
 * @package District5\ValidatorTests\Adapters
 */
class DateYYYMMDDTest extends TestCase
{
    public function testValid()
    {
        $instance = new DateYYYYMMDDValidator();
        $this->assertTrue($instance->isValid('2022-03-13'));
    }

    public function testMonthOutOfRange()
    {
        $instance = new DateYYYYMMDDValidator();
        $this->assertFalse($instance->isValid('2022-13-13'));
    }

    public function testDayOutOfRange()
    {
        $instance = new DateYYYYMMDDValidator();
        $this->assertFalse($instance->isValid('2022-03-33'));
    }
}
