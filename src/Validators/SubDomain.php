<?php

/**
 * District5 Validators Library
 *
 * @author      District5 <hello@district5.co.uk>
 * @copyright   District5 <hello@district5.co.uk>
 * @link        https://www.district5.co.uk
 *
 * MIT LICENSE
 *
 *  Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the
 *  "Software"), to deal in the Software without restriction, including
 *  without limitation the rights to use, copy, modify, merge, publish,
 *  distribute, sublicense, and/or sell copies of the Software, and to
 *  permit persons to whom the Software is furnished to do so, subject to
 *  the following conditions:
 *
 *  The above copyright notice and this permission notice shall be
 *  included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
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