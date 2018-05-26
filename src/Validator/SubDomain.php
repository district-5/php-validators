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
 * SubDomain
 *
 * Validates whether a value is in the format of a subdomain
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class SubDomain extends Regex
{

    /**
     * Based on the regex pattern http://www.mkyong.com/regular-expressions/domain-name-regular-expression-example/
     * modified to remove the final restriction {2,6} on the TLD, as longer TLD's are now available
     *
     * @var string
     */
    protected static $PATTERN_SINGLE_LEVEL = '/^(?!-)[A-Za-z0-9-]{1,63}(?<!-)$/';
    protected static $PATTERN_MULTI_LEVEL = '/^((?!-)[A-Za-z0-9-]{1,63}(?<!-)\\.)+$/';

    /**
     * Creates a new instance of SubDomain
     */
    public function __construct($singleLevel = true)
    {
        if (true === $singleLevel)
            parent::__construct(static::$PATTERN_SINGLE_LEVEL);
        else
            parent::__construct(static::$PATTERN_MULTI_LEVEL);
    }
}