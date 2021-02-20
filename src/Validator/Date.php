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
 * Validates whether a value is in the format of a Date
 *
 * @author District5
 * @package District5\Validator
 */
class Date extends Regex
{
    /**
     * Based on the regex pattern http://www.mkyong.com/regular-expressions/how-to-validate-date-with-regular-expression/
     * modified to re-order date for YYYY-MM-DD
     *
     * @var string
     */
    protected static $PATTERN = '/^((19|20)\\d\\d)-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])$/';

    /**
     * Creates a new instance of Date
     */
    public function __construct($options = array())
    {
        parent::__construct(static::$PATTERN, $options);
    }
}