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
    protected $_values = array();

    /**
     * Creates a new instance of NumericSpecificValues
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($options = array())
    {
        if (!array_key_exists('values', $options) || !isset($options['values'])) {
            throw new \InvalidArgumentException('A min value must be set for validation');
        }

        $this->_values = $options['values'];

        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validators\I::isValid()
     */
    public function isValid($value)
    {
        if (parent::isValid($value) === false) {
            return false;
        }

        foreach ($this->_values as $allowedValue) {
            if ($value === $allowedValue) {
                return true;
            }
        }

        return false;
    }
}