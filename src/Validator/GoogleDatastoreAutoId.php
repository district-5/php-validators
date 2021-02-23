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
 * Validates whether a value is an AutoId
 *
 * @author District5
 * @package District5\Validator
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
        if (parent::isValid($value) === false) {
            return false;
        }

        if ($value < 0) {
            return false;
        }

        // might need to improve this, find spec on what an auto id can look like

        return true;
    }
}