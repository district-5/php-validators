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
 * Validates whether a value consistent with one from a checkbox
 *
 * @author District5
 * @package District5\Validator
 */
class CheckboxValue extends A
{
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value)
	{
        return ($value == 'on' || $value == 'off');
	}
}