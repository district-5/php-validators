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

use \District5\Validator\AbstractValidator;

/**
 * Validates whether a value is a string of a certain length
 *
 * @author District5
 * @package District5\Validator
 */
class StringLength extends AbstractValidator
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
	public function __construct(array $options = [])
	{
		if (!isset($options['exact']) && !(isset($options['min']) || isset($options['max']))) {
            throw new \InvalidArgumentException('Either an "exact" value or "min" and|or "max" values must be set');
        }
		
		if (isset($options['exact'])) {
			$this->_min = $options['exact'];
			$this->_max = $options['exact'];

		} else {
			if (isset($options['min'])) {
                $this->_min = $options['min'];
            }

            if (isset($options['max'])) {
                $this->_max = $options['max'];
            }
		}

        $this->errorMessages['tooShort'] = 'Value is below the minimum string length';
        $this->errorMessages['tooLong'] = 'Value exceeds the maximum string length';

		parent::__construct($options);
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value): bool
	{
		if (!is_string($value)) {
            return false;
        }

		$len = strlen($value);
		
		if (null !== $this->_max && $len > $this->_max) {
			$this->setLastErrorMessage('tooLong');
			return false;
		}
		
		if (null !== $this->_min && $len < $this->_min) {
			$this->setLastErrorMessage('tooShort');
			return false;
		}

        return true;
	}
}
