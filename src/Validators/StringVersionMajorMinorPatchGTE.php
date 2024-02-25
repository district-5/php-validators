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
 * Validates whether a value is at least equal to a Major.Minor.Patch version number
 * i.e. '1.3.7' is at least '1.2.12'
 *
 * @author District5
 * @package District5\Validator
 */
class StringVersionMajorMinorPatchGTE extends A
{
    /**
     * @var int
     */
    protected $_min;

    /**
     * Creates a new instance of StringVersionMajorMinorPatchGTE
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($options = array())
    {
        if (!array_key_exists('min', $options)) {
            throw new \InvalidArgumentException('A min version number value must be set for validation');
        }

        $this->_min = explode('.', $options['min']);

        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validators\I::isValid()
     */
    public function isValid($value)
    {
        $parts = explode('.', $value);

        if (count($parts) !== 3) {
            return false;
        }

        if (false === is_numeric($parts[0]) || false === is_numeric($parts[1]) || false === is_numeric($parts[2])) {
            return false;
        }

        if ((int)$parts[0] < (int)$this->_min[0]) {
            // Major version number is less
            return false;
        }

        if ((int)$parts[0] > (int)$this->_min[0]) {
            // Major version number is greater than the minimum, no point checking further
            return true;
        }

        if((int)$parts[1] < (int)$this->_min[1]) {
            // Major version number is the same, but minor version is less
            return false;
        }

        if ((int)$parts[1] > (int)$this->_min[1]) {
            // Major version number is the same, but minor is greater than, no point checking further
            return true;
        }

        if ((int)$parts[2] < (int)$this->_min[2]) {
            // Major and minor version are the same, but the patch version is less
            return false;
        }

        return true;
    }
}