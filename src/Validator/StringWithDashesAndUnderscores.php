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
namespace District5\Validator;

/**
 * StringWithDashesAndUnderscores
 *
 * Validates whether a value is a string with dashes and underscores
 *
 * @author Mark Morgan <mark.morgan@district5.co.uk>
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