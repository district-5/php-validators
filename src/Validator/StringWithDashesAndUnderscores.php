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
 * Validates whether a value is a string with dashes and underscores
 *
 * @author District5
 * @package District5\Validator
 */
class StringWithDashesAndUnderscores extends Regex
{
	/**
	 * @var string
	 */
	protected $_patternToMatch = '/^[0-9a-zA-Z_\-]{1,}$/';
	
	/**
	 * Creates a new instance of StringWithDashesAndUnderscores
	 */
	public function __construct()
	{
		parent::__construct($this->_patternToMatch);
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
		return parent::isValid($value);
	}
}