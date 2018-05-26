<?php

/**
 * District5 - Validators
 *
 * @copyright District5
 *
 * @author District5
 * @link https://www.district5.co.uk
 *
 * @license This software and associated documentation (the "Software") may not be
 * used, copied, modified, distributed, published or licensed to any 3rd party
 * without the written permission of District5 or its author.
 *
 * The above copyright notice and this permission notice shall be included in
 * all licensed copies of the Software.
 */
namespace District5\Validate;

/**
 * StringInArrayOfStrings
 *
 * Validates whether a value is in an array of string values
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class StringInArrayOfStrings extends A
{
    /**
     * @var array
     */
    protected $_allowedStrings = array();

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        if (null == $value) {
            return false;
        }

        if (in_array($value, $this->_allowedStrings, true)) {
            return true;
        }

        return false;
    }
}