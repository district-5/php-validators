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
namespace District5\Validate;

/**
 * HexColour
 *
 * Validates whether a value is a hex colour string
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
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