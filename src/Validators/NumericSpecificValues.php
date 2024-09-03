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
 * Validates whether a value is a specific numeric value
 *
 * @author District5
 * @package District5\Validator
 */
class NumericSpecificValues extends Numeric
{
    /**
     * @var array
     */
    protected $values = array();

    /**
     * Creates a new instance of NumericSpecificValues
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options = [])
    {
        if (!isset($options['values'])) {
            throw new \InvalidArgumentException('An array of values must be set for validation');
        }

        $this->values = $options['values'];

        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validators\I::isValid()
     */
    public function isValid($value): bool
    {
        if (parent::isValid($value) === false) {
            return false;
        }

        foreach ($this->values as $allowedValue) {
            if ($value === $allowedValue) {
                return true;
            }
        }

        return false;
    }
}
