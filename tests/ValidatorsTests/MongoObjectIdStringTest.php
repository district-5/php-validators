<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\MongoObjectIdString;
use PHPUnit\Framework\TestCase;

/**
 * Class MongoObjectIdStringTest
 * @package District5\ValidatorTests
 */
class MongoObjectIdStringTest extends TestCase
{
    public function testSingleValidValue()
    {
        $value = '65faaa251371b9dce2024a50';
        $instance = new MongoObjectIdString();

        $this->assertTrue($instance->isValid($value));
    }

    public function testSingleInvalidValuesToShort()
    {
        $value = '65faaa251371b9dce2024a';
        $instance = new MongoObjectIdString();

        $this->assertFalse($instance->isValid($value));
    }
}

