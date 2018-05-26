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
namespace District5\Validator;

/**
 * IntegerRange
 *
 * Validates whether a value is an integer and within a given range
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class IntegerRange extends Integer
{

    /**
     * @var int
     */
    protected $_min = null;

    /**
     * @var int
     */
    protected $_max = null;

    /**
     * Creates a new instance of IntRange
     *
     * @param array $options            
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($options = array())
    {
        if (!array_key_exists('min', $options) && !array_key_exists('max', $options))
        {
            throw new \InvalidArgumentException('A min or a max value must be set for validation');
        }

        if (!isset($this->_min) && array_key_exists('min', $options))
            $this->_min = $options['min'];
        if (!isset($this->_max) && array_key_exists('max', $options))
            $this->_max = $options['max'];
        
        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validator\Numeric::isValid()
     */
    public function isValid($value)
    {
        if (!parent::isValid($value))
            return false;
        
        if (null !== $this->_min && $value < $this->_min)
        {
        	$this->setLastErrorMessage('too_short');
            return false;
        }
        
        if (null !== $this->_max && $value > $this->_max)
        {
        	$this->setLastErrorMessage('too_long');
            return false;
        }
        
        return true;
    }
}