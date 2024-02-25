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
namespace District5\Validators;

/**
 * Validates whether a value is an array of numbers
 *
 * @author District5
 * @package District5\Validator
 */
class ArrayOfNumbers extends A
{
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value)
	{
        if (!is_array($value))
            return false;

        $validator = new \District5\Validators\Numeric();
        foreach ($value as $singleValue)
        {
            if (!$validator->isValid($singleValue))
                return false;
        }

		return true;
	}
}