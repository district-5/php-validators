<?php

namespace District5\ValidatorTests;

use District5\Validator\BoolValue;
use District5\Validator\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailAddressTest
 * @package District5\ValidatorTests\Adapters
 */
class EmailAddressTest extends TestCase
{
    public function testValidSimple()
    {
        $instance = new EmailAddress();
        $this->assertTrue($instance->isValid('foo@bar.com'));
        $this->assertTrue($instance->isValid('foo@gmail.com'));
    }

    public function testValidDeep()
    {
        $instance = new EmailAddress(
            [
                'deep' => true
            ]
        );
        $this->assertTrue($instance->isValid('foo@outlook.com'));
        $this->assertTrue($instance->isValid('foo@gmail.com'));
    }

    public function testInvalidDeep()
    {
        $instance = new EmailAddress(
            [
                'deep' => true
            ]
        );
        $this->assertFalse($instance->isValid('foo@random' . sha1(uniqid()) . '.com'));
        $this->assertFalse($instance->isValid('foo@random' . sha1(uniqid()) . '.com'));
    }
}

