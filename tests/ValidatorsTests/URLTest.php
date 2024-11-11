<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\URL;
use PHPUnit\Framework\TestCase;

/**
 * Class URLTest
 * @package District5\ValidatorTests\Adapters
 */
class URLTest extends TestCase
{
    public function testValidURL()
    {
        $instance = new URL();

        $this->assertTrue($instance->isValid("https://www.district5.co.uk"));
        $this->assertNull($instance->getLastErrorMessageKey());
    }

    public function testValidURLDefaultSchemes()
    {
        $instance = new URL();

        $this->assertTrue($instance->isValid("https://www.district5.co.uk"));
        $this->assertTrue($instance->isValid("http://www.district5.co.uk"));
        $this->assertTrue($instance->isValid("ftp://www.district5.co.uk"));
    }

    public function testInvalidURLBadScheme()
    {
        $instance = new URL();

        $this->assertFalse($instance->isValid("ssh://www.district5.co.uk"));
    }

    public function testInvalidURLEndOnPeriod()
    {
        $instance = new URL();

        $this->assertFalse($instance->isValid("ssh://www.district5.co."));
    }
}
