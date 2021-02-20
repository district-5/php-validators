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
 * Validates whether a value is a MongoId
 *
 * @author District5
 * @package District5\Validator
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
		if ($this->_strictMode === true && !$value instanceof \MongoDB\BSON\ObjectId) {
			return false;
		}
		
		return parent::isValid($value);
	}
}