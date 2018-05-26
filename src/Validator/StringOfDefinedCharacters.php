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
 * StringOfDefinedCharacters
 *
 * Validates whether a string contains a set of defined characters
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
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