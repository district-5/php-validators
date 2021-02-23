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
 * Validates whether a string contains a set of defined characters
 *
 * @author District5
 * @package District5\Validator
 */
class StringOfDefinedCharacters extends Regex
{
	protected $_allowedCharactersStr;

	protected static $PATTERN_PREPENDER = '/^[';
	protected static $PATTERN_APPENDER = ']{1,}$/';
	
	/**
	 * Creates a new instance of StringOfDefinedCharacters
	 * 
	 * @param string $allowedCharactersStr
	 */
	public function __construct($allowedCharactersStr)
	{
		$this->_allowedCharactersStr = $allowedCharactersStr;

		parent::__construct(static::$PATTERN_PREPENDER . $this->_allowedCharactersStr . static::$PATTERN_APPENDER);
	}
}