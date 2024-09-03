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
use District5\Validators\Numeric as NumericValidator;

/**
 * ArrayOfNumbers
 *
 * Validates whether an array of values only contains numbers.
 */
class ArrayOfNumbers extends AbstractValidator
{
    /**
     * @var string[]
     */
    protected array $errorMessages = [
        'notArray' => 'The given value is not an array'
    ];

    /**
     * @var NumericValidator
     */
    private NumericValidator $numericValidator;

    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $this->numericValidator = new NumericValidator();
    }

    /**
	 * (non-PHPdoc)
	 * 
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value): bool
	{
        if (!is_array($value)) {
            $this->setLastErrorMessage('notArray');
            return false;
        }

        foreach ($value as $singleValue) {
            if (!$this->numericValidator->isValid($singleValue)) {
                return false;
            }
        }

		return true;
	}

    /**
     * @return string|null
     */
    public function getLastErrorMessage(): ?string
    {
        $parentError = parent::getLastErrorMessage();
        if (null === $parentError) {
            return $this->numericValidator->getLastErrorMessage();
        }

        return $parentError;
    }

    /**
     * @return string|null
     */
    public function getLastErrorMessageKey(): ?string
    {
        $parentError = parent::getLastErrorMessageKey();
        if (null === $parentError) {
            return $this->numericValidator->getLastErrorMessageKey();
        }

        return $parentError;
    }
}
