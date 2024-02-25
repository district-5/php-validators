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
 * Validates whether a value matches a regex
 *
 * @author District5
 * @package District5\Validator
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
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value)
	{
		if (!is_string($value) && !is_int($value) && !is_float($value)) {
            return false;
        }

        $status = preg_match($this->_pattern, $value);
		// TODO: is this correct, should 0 be mismatch, false be error??
        if ($status === false) {
            $this->setLastErrorMessage('PATTERN_MISMATCH');
            return false;
        }

        if (!$status) {
            return false;
        }

        return true;
	}
}