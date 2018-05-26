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
namespace District5\Validator;

/**
 * CheckboxValue
 *
 * Validates whether a value consistent with one from a checkbox
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class CheckboxValue extends A
{
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
        return ($value == 'on' || $value == 'off');
	}
}