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
 * Validates whether a value is a hex colour string
 *
 * @author District5
 * @package District5\Validator
 */
class HexColour extends Regex
{
    protected static $PATTERN = '/^([#]{0,1})([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/';

    /**
     * Creates a new instance of HexColour
     */
    public function __construct()
    {
        parent::__construct(static::$PATTERN);
    }
}