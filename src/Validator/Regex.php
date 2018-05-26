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
 * Regex
 *
 * Validates whether a value matches a regex
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class Regex extends A
{
	
	/**
	 * Regular expression pattern
	 *
	 * @var string
	 */
	protected $_pattern;
	
	/**
	 * Creates a new instance of Regex
	 * 
	 * @param string $pattern
	 */
	public function __construct($pattern, $options = array())
	{
		$this->setPattern($pattern);

        parent::__construct($options);
	}
	
	/**
	 * Sets the pattern option
	 *
	 * @param  string $pattern
	 * 
	 * @throws \InvalidArgumentException if there is a fatal error in pattern matching
	 * @return Regex Provides a fluent interface
	 */
	public function setPattern($pattern)
	{
		$this->_pattern = (string)$pattern;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validate\I::isValid()
	 */
	public function isValid($value)
	{
		if (!is_string($value) && !is_int($value) && !is_float($value))
            return false;

        $status = preg_match($this->_pattern, $value);
        if (false === $status)
        {
            $this->setLastErrorMessage('PATTERN_MISMATCH');
            return false;
        }

        if (!$status)
            return false;

        return true;
	}
}