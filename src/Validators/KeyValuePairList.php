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

use District5\Validator\AbstractValidator;
use District5\Validators\StringWithDashesDotsAndUnderscores;

class KeyValuePairList extends AbstractValidator
{
    /**
     * @var bool
     */
    private bool $allowBoolean, $allowFloat, $allowInteger, $allowNull, $allowString;
//    private bool $allowFloat;
//    private bool $allowInteger;
//    private bool $allowNull;
//    private bool $allowString;

    public function __construct(
        bool $allowBoolean = true,
        bool $allowFloat = true,
        bool $allowInteger = true,
        bool $allowNull = false,
        bool $allowString = true
    )
    {
        $this->allowBoolean = $allowBoolean;
        $this->allowFloat = $allowFloat;
        $this->allowInteger = $allowInteger;
        $this->allowNull = $allowNull;
        $this->allowString = $allowString;

        parent::__construct();

        $this->errorMessages['notValidValue'] = 'The given value is not a valid key value pair array';
        $this->errorMessages['notValidKey'] = 'The given value has invalid keys';
    }

    public function isValid($value): bool
    {
        if (null === $value) {
            return false;
        }

        if (!is_array($value)) {
            $this->setLastErrorMessage('notValidValue');
            return false;
        }

        $keyValidator = new StringWithDashesDotsAndUnderscores();

        foreach ($value as $k => $v) {

            if (!$keyValidator->isValid($k)) {
                $this->setLastErrorMessage('notValidKey');
                return false;
            }

            if (true === $this->allowString && is_string($v)) {
                continue;
            }

            if (true === $this->allowInteger && is_int($v)) {
                continue;
            }

            if (true === $this->allowBoolean && is_bool($v)) {
                continue;
            }

            if (true === $this->allowFloat && is_float($v)) {
                continue;
            }

            if (true === $this->allowNull && is_null($v)) {
                continue;
            }

            $this->setLastErrorMessage('notValidValue');
            return false;
        }

        return true;
    }
}
