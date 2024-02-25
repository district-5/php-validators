<?php

/**
 * District5 Validators Library
 *
 * @author      District5 <hello@district5.co.uk>
 * @copyright   District5 <hello@district5.co.uk>
 * @link        https://www.district5.co.uk
 *
 * MIT LICENSE
 *
 *  Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the
 *  "Software"), to deal in the Software without restriction, including
 *  without limitation the rights to use, copy, modify, merge, publish,
 *  distribute, sublicense, and/or sell copies of the Software, and to
 *  permit persons to whom the Software is furnished to do so, subject to
 *  the following conditions:
 *
 *  The above copyright notice and this permission notice shall be
 *  included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace District5\Validators;

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