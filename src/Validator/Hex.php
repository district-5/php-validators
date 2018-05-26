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
 * Hex
 *
 * Validates whether a value is hex
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class Hex extends A
{
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
		if (!is_string($value) && !is_int($value)) {
            return false;
        }

        if (!ctype_xdigit((string) $value)) {
            return false;
        }

        return true;
	}
}