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
 * EmailAddress
 *
 * Integrated into validator structure from EmailAddressValidator Class
 * ------------------------------------------------------------
 * http://code.google.com/p/php-email-address-validation/
 * 
 * Released under New BSD license
 * http://www.opensource.org/licenses/bsd-license.php
 * ------------------------------------------------------------
 */
class EmailAddress extends AbstractValidator
{
    /**
     * @var string[]
     */
    protected $errorMessages = [
        'generic' => 'Email address invalid',
        'dnsMxVerificationFailed' => 'Email address domain failed MX records lookup',
        'missingAtSymbol' => 'Email address is missing @ symbol',
        'tooManyAtSymbols' => 'Email address has more than 1x @ symbol',
        'tooShort' => 'Email address too short',
        'tooLong' => 'Email address too long'
    ];

    /**
     * @var bool
     */
    protected $deepCheck = false;

    /**
     * EmailAddress constructor.
     * @param array $options
     */
	public function __construct(array $options = [])
    {
        parent::__construct($options);

        if (isset($options['deep']) && $options['deep'] === true) {
            $this->deepCheck = true;
        }
    }

    /**
	 * (non-PHPdoc)
	 *
	 * @see \District5\Validators\I::isValid()
	 */
	public function isValid($value): bool
	{
	    $isValid = $this->check_email_address($value);
	    if ($isValid === false) {
	        return false;
        }

	    if ($this->deepCheck === false) {
	        // if we dont want to do a deep check and we get this far, it passed the initial regex check
            return true;
        }

	    $passesMxVerification = $this->performMxVerification($value);
        if (false === $passesMxVerification) {
            $this->setLastErrorMessage('dnsMxVerificationFailed');
        }

        return $passesMxVerification;
	}

    /**
     * Perform a deep check on the domain part of the email address.
     *
     * @param string $value
     * @return bool
     */
    protected function performMxVerification(string $value): bool
    {
        $email = explode('@', $value);
        if (count($email) !== 2) {
            return false;
        }

        $domain = $email[1];
        $records = dns_get_record($domain, DNS_MX);

        return count($records) > 0;
    }
	
	/**
	 * Check email address validity
	 * 
	 * @param string $strEmailAddress Email address to be checked
	 * 
	 * @return True if email is valid, false if not
	 */
	protected function check_email_address(string $strEmailAddress): bool
	{
		// If magic quotes is "on", email addresses with quote marks will
		// fail validation because of added escape characters. Uncommenting
		// the next three lines will allow for this issue.
		//if (get_magic_quotes_gpc()) {
		//    $strEmailAddress = stripslashes($strEmailAddress);
		//}
	
		// Control characters are not allowed
		if (preg_match('/[\x00-\x1F\x7F-\xFF]/', $strEmailAddress))
		{
			$this->setLastErrorMessage('generic');
			return false;
		}
	
		// Check email length - min 3 (a@a), max 256
		if (!$this->check_text_length($strEmailAddress, 3, 256)) {
			return false;
		}
	
		// Split it into sections using last instance of "@"
		$intAtSymbol = strrpos($strEmailAddress, '@');
		if ($intAtSymbol === false) {
			// No "@" symbol in email.
			$this->setLastErrorMessage('missingAtSymbol');
			return false;
		}

		$arrEmailAddress[0] = substr($strEmailAddress, 0, $intAtSymbol);
		$arrEmailAddress[1] = substr($strEmailAddress, $intAtSymbol + 1);
	
		// Count the "@" symbols. Only one is allowed, except where
		// contained in quote marks in the local part. Quickest way to
		// check this is to remove anything in quotes. We also remove
		// characters escaped with backslash, and the backslash
		// character.
		$arrTempAddress[0] = preg_replace('/\./'
				,''
				,$arrEmailAddress[0]);
		$arrTempAddress[0] = preg_replace('/"[^"]+"/'
				,''
				,$arrTempAddress[0]);
		$arrTempAddress[1] = $arrEmailAddress[1];
		$strTempAddress = $arrTempAddress[0] . $arrTempAddress[1];
		// Then check - should be no "@" symbols.
		if (strrpos($strTempAddress, '@') !== false) {
			// "@" symbol found
			$this->setLastErrorMessage('tooManyAtSymbols');
			return false;
		}
	
		// Check local portion
		if (!$this->check_local_portion($arrEmailAddress[0])) {
			$this->setLastErrorMessage('generic');
			return false;
		}
	
		// Check domain portion
		if (!$this->check_domain_portion($arrEmailAddress[1])) {
			$this->setLastErrorMessage('generic');
			return false;
		}
	
		// If we're still here, all checks above passed. Email is valid.
		return true;
	}
	
	/**
	 * Checks email section before "@" symbol for validity
	 * 
	 * @param string $strLocalPortion Text to be checked
	 * 
	 * @return True if local portion is valid, false if not
	 */
	protected function check_local_portion(string $strLocalPortion): bool
	{
		// Local portion can only be from 1 to 64 characters, inclusive.
		// Please note that servers are encouraged to accept longer local
		// parts than 64 characters.
		if (!$this->check_text_length($strLocalPortion, 1, 64)) {
			return false;
		}
		// Local portion must be:
		// 1) a dot-atom (strings separated by periods)
		// 2) a quoted string
		// 3) an obsolete format string (combination of the above)
		$arrLocalPortion = explode('.', $strLocalPortion);
		for ($i = 0, $max = sizeof($arrLocalPortion); $i < $max; $i++) {
			if (!preg_match('.^('
					.    '([A-Za-z0-9!#$%&\'*+/=?^_`{|}~-]'
					.    '[A-Za-z0-9!#$%&\'*+/=?^_`{|}~-]{0,63})'
					.'|'
					.    '("[^\\\"]{0,62}")'
					.')$.'
					,$arrLocalPortion[$i])) {
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Checks email section after "@" symbol for validity
	 * 
	 * @param string $strDomainPortion Text to be checked
	 * 
	 * @return bool True if domain portion is valid, false if not
	 */
	protected function check_domain_portion(string $strDomainPortion): bool
	{
		// Total domain can only be from 1 to 255 characters, inclusive
		if (!$this->check_text_length($strDomainPortion, 1, 255)) {
			return false;
		}
		// Check if domain is IP, possibly enclosed in square brackets.
		if (preg_match('/^(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])'
				.'(\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])){3}$/'
				,$strDomainPortion) ||
				preg_match('/^\[(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])'
						.'(\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])){3}\]$/'
						,$strDomainPortion)) {
			return true;
		} else {
			$arrDomainPortion = explode('.', $strDomainPortion);
			if (sizeof($arrDomainPortion) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0, $max = sizeof($arrDomainPortion); $i < $max; $i++) {
				// Each portion must be between 1 and 63 characters, inclusive
				if (!$this->check_text_length($arrDomainPortion[$i], 1, 63)) {
					return false;
				}

				if (!preg_match('/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|'
						.'([A-Za-z0-9]+))$/', $arrDomainPortion[$i])) {
					return false;
				}

				if ($i == $max - 1) { // TLD cannot be only numbers
					if (strlen(preg_replace('/[0-9]/', '', $arrDomainPortion[$i])) <= 0) {
						return false;
					}
				}
			}
		}

		return true;
	}
	
	/**
	 * Check given text length is between defined bounds
	 * 
	 * @param string $strText Text to be checked
	 * @param int $intMinimum Minimum acceptable length
	 * @param int $intMaximum Maximum acceptable length
	 * 
	 * @return bool True if string is within bounds (inclusive), false if not
	 */
	protected function check_text_length(string $strText, int $intMinimum, int $intMaximum): bool
	{
		// Minimum and maximum are both inclusive
		$intTextLength = strlen($strText);
		if ($intTextLength < $intMinimum) {
			$this->setLastErrorMessage('tooShort');
			return false;

		} else if ($intTextLength > $intMaximum) {
			$this->setLastErrorMessage('tooLong');
			return false;

		} else {
			return true;
		}
	}
}
