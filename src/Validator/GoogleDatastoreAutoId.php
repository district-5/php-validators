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
 * GoogleDatastoreAutoId
 *
 * Validates whether a value is an AutoId
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 *
 */
class GoogleDatastoreAutoId extends Numeric
{

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validator\I::isValid()
     */
    public function isValid($value)
    {
        if (false === parent::isValid($value))
            return false;

        if ($value < 0)
            return false;

        // TODO: improve this, find spec on what an auto id can look like

        return true;
    }
}