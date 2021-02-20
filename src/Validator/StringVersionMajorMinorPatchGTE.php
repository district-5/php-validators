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
     * @see \District5\Validator\I::isValid()
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