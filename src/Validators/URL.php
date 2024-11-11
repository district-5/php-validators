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
 * Validates whether a value is in the format of a url
 *
 * @author District5
 * @package District5\Validator
 */
class URL extends AbstractValidator
{
    private const SCHEME_PATTERN = '/^[a-z][a-z0-9+\.-]*$/Di';

    /**
     * Based on the regex pattern by https://github.com/Fleshgrinder/php-url-validator
     *
     * @var string
     */
    private const PATTERN = '/^
            (?\'scheme\'%s)
            :\/\/
            (?:
                (?\'username\'.+)
                (?::(?\'password\'.+))?
            @)?
            (?\'hostname\'
                (?!\.)
                (?\'domain\'(?:\.?(?:xn--[[:alnum:]-]+|(?!..--)[[:alnum:]\x{00a1}-\x{ffff}]+-*))+)
                (?<!-)
                (?:\.(?\'tld\'(?:[a-z\x{00a1}-\x{ffff}]{2,}|xn--[[:alnum:]-]+)))
                    |
                (?\'ipv4\'
                    (?!(?:10|127)(?:\.\d{1,3}){3})
                    (?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})
                    (?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})
                    (?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])
                    (?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}
                    (?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))
                )
                    |
                (?\'ipv6\'
                    \[
                        (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                    \]
                )
            )
            (?::(?\'port\'\d+))?
            (?:(?=\/)
                (?\'path\'\/[^\?\#\s[:cntrl:]]*)?
                (?:\?(?\'query\'[^\#\s[:cntrl:]]*))?
                (?:\#(?\'fragment\'[^\s[:cntrl:]]*))?
            )?
        $/DiuUx';

    protected array $allowedSchemes = ["http", "https", "ftp"];

    /**
     * Creates a new instance of URL
     */
    public function __construct($allowedSchemes = null)
    {
        parent::__construct();

        if (null !== $allowedSchemes) {
            $this->setSchemes($allowedSchemes);
        }
    }

    /**
     * Overrides the default built-in schemes
     *
     * @param array $allowedSchemes
     *
     * @throws \InvalidArgumentException
     */
    protected function setSchemes(array $allowedSchemes)
    {
        if (empty($allowedSchemes)) {
            throw new \InvalidArgumentException("Allowed schemes cannot be empty.");
        }

        $c = count($allowedSchemes);
        for ($i = 0; $i < $c; ++$i) {
            if (empty($allowedSchemes[$i])) {
                throw new \InvalidArgumentException("An allowed scheme cannot be empty.");
            } elseif (!preg_match(static::SCHEME_PATTERN, $allowedSchemes[$i])) {
                throw new \InvalidArgumentException("Allowed scheme [{$allowedSchemes[$i]}] contains illegal characters (see RFC3986).");
            }
        }

        $this->allowedSchemes = $allowedSchemes;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validators\I::isValid()
     */
    public function isValid($value): bool
    {
        if ($value === null || $value === "") {
            return false;
        }

        // No need to continue with boolean, float, integer, or what not since they will never contain a valid URL.
        if (!is_string($value)) {
            return false;
        }

        // NFC form is a requirement for a valid URL.
        if (strlen($value) !== strlen(utf8_decode($value)) && $value !== \Normalizer::normalize($value, \Normalizer::NFC)) {
//            throw new \InvalidArgumentException("URL must be in Unicode normalization form NFC.");
            return false;
        }

        if (!preg_match(sprintf(static::PATTERN, implode("|", $this->allowedSchemes)), $value, $matches)) {
//            throw new \InvalidArgumentException("URL [{$url}] is invalid.");
            return false;
        }
        foreach ($matches as $property => $value) {
            if (!is_numeric($property) && !empty($value)) {
                $this->{$property} = $value;
            }
        }

        return true;
    }
}