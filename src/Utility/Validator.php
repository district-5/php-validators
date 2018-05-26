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
namespace District5\Utility;

/**
 * Validate
 *
 * A utility for validating items, useful for single instance use of a validator
 *
 * @author Mark Morgan
 */
class Validator
{

    /**
     * Checks whether a value is a valid bool
     *
     * @param mixed $value The value to validate
     *
     * @return bool True if value is a bool, false otherwise
     */
    public static function IsValidBool($value)
    {
        $validator = new \District5\Validator\BoolValue();

        return $validator->isValid($value);
    }

    /**
     * Checks whether a value is a valid Google Cloud Datastore AutoId
     *
     * @param mixed $value The value to validate
     *
     * @return bool True if the value is an AutoId, false otherwise
     */
    public static function IsValidGoogleDatastoreAutoId($value)
    {
        $validator = new \District5\Validator\GoogleDatastoreAutoId();

        return $validator->isValid($value);
    }

    /**
     * Checks whether a value is a valid MongoId
     *
     * @param mixed $value The value to validate
     * @param bool $strict A flag indicating when a strict validation is required (must be an instanceof MongoId)
     *
     * @return bool True if value is a MongoId, false otherwise
     */
    public static function IsValidMongoId($value, $strict = false)
    {
        $validator = new \District5\Validator\MongoId($strict);

        return $validator->isValid($value);
    }
}