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
 * Validates whether a value is an array of MongoId's
 *
 * @author District5
 * @package District5\Validator
 */
class ArrayOfMongoId extends A
{
	/**
	 * @var bool
	 */
	protected $_strictMode;
	
	/**
	 * Creates a new instance of ArrayOfMongoId
	 * 
	 * @param bool $strict Flag indicating whether strict typing should be used
	 */
	public function __construct($strict = false)
	{
		$this->_strictMode = $strict;

		parent::__construct(array());
	}
	
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \District5\Validator\I::isValid()
	 */
	public function isValid($value)
	{
        if (!is_array($value))
        {
            return false;
        }

        $validator = new \District5\Validator\MongoId($this->_strictMode);
        foreach ($value as $singleValue)
        {
            if (!$validator->isValid($singleValue))
            {
                return false;
            }
        }

		return true;
	}
}