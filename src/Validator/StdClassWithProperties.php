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
 * StdClassWithProperties
 *
 * Validates whether a value is a StdClass with properties
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class StdClassWithProperties extends A
{

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validator\I::isValid()
     */
    public function isValid($value)
    {
    	if (!($value instanceof \stdClass))
        	return false;
    	
    	return count(get_object_vars($value)) > 0;
    }
}