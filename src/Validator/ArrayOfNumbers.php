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
 * ArrayOfNumbers
 *
 * Validates whether a value is an array of numbers
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class ArrayOfNumbers extends A
{
	
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
        if (!is_array($value))
            return false;

        $validator = new \District5\Validator\Numeric();
        foreach ($value as $singleValue)
        {
            if (!$validator->isValid($singleValue))
                return false;
        }

		return true;
	}
}