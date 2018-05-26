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
 * StringLength
 *
 * Validates whether a value is a string of a certain length
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class StringLength extends A
{
	
	/**
	 * The minimum string length
	 * 
	 * @var int
	 */
	protected $_min = null;
	
	/**
	 * The maximum string length
	 * 
	 * @var int
	 */
	protected $_max = null;
	
	/**
	 * Creates a new instance of StringLength
	 * 
	 * @param array $options
     *
     * @throws \InvalidArgumentException
	 */
	public function __construct($options = array())
	{
		if (!isset($options['exact']) && !(isset($options['min']) || isset($options['max'])))
			throw new \InvalidArgumentException('Either an "exact" value or "min" and|or "max" values must be set');
		
//		if (!isset($options['exact']) && !isset($options['max']))
//			throw new \InvalidArgumentException('Either an "exact" value or "min" and|or "max" values must be set');
		
		if (isset($options['exact']))
		{
			$this->_min = $options['exact'];
			$this->_max = $options['exact'];
		}
		else
		{
			if (isset($options['min']))
			    $this->_min = $options['min'];

            if (isset($options['max']))
			    $this->_max = $options['max'];
		}

        if (null === $this->_min && null === $this->_max)
            throw new \InvalidArgumentException('No values for "min" or "max" have been set');
		
		parent::__construct($options);
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
		if (!is_string($value))
            return false;

		$len = strlen($value);
		
		if (null !== $this->_max && $len > $this->_max)
		{
			$this->setLastErrorMessage('too_long');
			return false;
		}
		
		if (null !== $this->_min && $len < $this->_min)
		{
			$this->setLastErrorMessage('too_short');
			return false;
		}

        return true;
	}
}