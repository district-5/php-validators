<?php

namespace District5Tests\ValidatorsTests;

use District5\Validators\StringWithDashesAndDotsRestrictedFirstAndLastNoDoubleSeparators as Validator;
use PHPUnit\Framework\TestCase;

class StringWithDashesAndDotsRestrictedFirstAndLastNoDoubleSeparatorsTest extends TestCase
{

    public function testValidValidatorJustAlnum()
    {
        $id = 'abc123';
        $validator = new Validator();

        $this->assertTrue($validator->isValid($id));
    }

    public function testInvalidValidatorJustSeparators()
    {
        $id = '.-.-.';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testValidValidatorWithDotsAndDashes()
    {
        $id = 'category.subcat.final-item';
        $validator = new Validator();

        $this->assertTrue($validator->isValid($id));
    }

    public function testValidValidatorEndsWithNumber()
    {
        $id = 'category.subcat.final-item5';
        $validator = new Validator();

        $this->assertTrue($validator->isValid($id));
    }

    public function testInvalidValidatorDoubleDots()
    {
        $id = 'category.subcat..final-item';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorDoubleDashes()
    {
        $id = 'category.subcat.final--item';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorStartsWithDot()
    {
        $id = '.category.subcat.final-item';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorStartsWithDash()
    {
        $id = '-category.subcat.final-item';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorStartsWithNumber()
    {
        $id = '5category.subcat.final-item';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorEndsWithDot()
    {
        $id = 'category.subcat.final-item.';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }

    public function testInvalidValidatorEndsWithDash()
    {
        $id = 'category.subcat.final-item-';
        $validator = new Validator();

        $this->assertFalse($validator->isValid($id));
    }
}
