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
namespace District5\Validators;

/**
 * Validates whether a value is in the format of a subdomain
 *
 * @author District5
 * @package District5\Validator
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
        if (true === $singleLevel) {
            parent::__construct(static::$PATTERN_SINGLE_LEVEL);
        } else {
            parent::__construct(static::$PATTERN_MULTI_LEVEL);
        }
    }
}