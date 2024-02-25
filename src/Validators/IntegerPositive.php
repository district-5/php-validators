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
 * Validates whether a value is a positive integer
 *
 * @author District5
 * @package District5\Validator
 */
class IntegerPositive extends Integer
{
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value)
	{
        if (!parent::isValid($value)) {
            return false;
        }

        if ($value < 1) {
            return false;
        }

        return true;
	}
}