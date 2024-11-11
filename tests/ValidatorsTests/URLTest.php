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

    public function testValidURLOverriddenSchemes()
    {
        $instance = new URL([
            'https',
            'ssh'
        ]);

        $this->assertTrue($instance->isValid("https://www.district5.co.uk"));
        $this->assertTrue($instance->isValid("ssh://www.district5.co.uk"));

        $this->assertFalse($instance->isValid("http://www.district5.co.uk"));
    }

    public function testInvalidOverriddenSchemes()
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = new URL([]);
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
