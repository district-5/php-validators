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
 * Validates whether a value is a JSON serialised string
 *
 * @author District5
 * @package District5\Validator
 */
class JSONString extends A
{
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value)
	{
        if ($value === null) {
            return false;
        }

        if (trim($value) === "") {
            return false;
        }

        $json = json_decode($value);
        return (json_last_error() === JSON_ERROR_NONE);
	}
}