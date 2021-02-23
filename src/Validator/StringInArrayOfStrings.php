<?php

/**
 * District5 - Validators
 *
 * @copyright District5
 *
 * @author District5
 * @link https://www.district5.co.uk
 *
 * @license MIT
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies of the Software.
 */
namespace District5\Validator;

/**
 * Validates whether a value is in an array of string values
 *
 * @author District5
 * @package District5\Validator
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