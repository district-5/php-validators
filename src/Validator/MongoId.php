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
 * MongoId
 *
 * Validates whether a value is a MongoId
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
 */
class MongoId extends Regex
{
	
	/**
	 * @var string $idPattern
	 */
	protected $_patternToMatch = '/^[0-9a-z]{24}$/';
	
	/**
	 * @var bool
	 */
	protected $_strictMode;
	
	/**
	 * Creates a new instance of MongoId
	 * 
	 * @param bool $strict Flag indicating whether strict typing should be used
	 */
	public function __construct($strict = false)
	{
		$this->_strictMode = $strict;
		
		parent::__construct($this->_patternToMatch);
	}
	
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
		if ($this->_strictMode === true && !$value instanceof \MongoId)
		{
			return false;
		}
		
		return parent::isValid($value);
	}
}