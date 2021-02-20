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
 * Validates whether a value is an object with latitude and longitude properties
 *
 * @author District5
 * @package District5\Validator
 */
class LatLonObject extends A
{
    protected $_requiresHorizontalAccuracy = false;

    /**
     * Creates a new instance of LatLonObject
     *
     * @param bool $requiresHorizontalAccuracy
     * @param array $options
     */
    public function __construct($requiresHorizontalAccuracy = false, $options = array())
    {
        $this->_requiresHorizontalAccuracy = $requiresHorizontalAccuracy;

        parent::__construct($options);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \District5\Validator\I::isValid()
     */
    public function isValid($value)
    {
        if (null === $value) {
            $this->setLastErrorMessage('Missing value for lat lon object');
            return false;
        }

        $lat = null;
        $lon = null;
        $accuracyHorizontal = null;

        if ($value instanceof \stdClass) {
            // find the latitude value
            if (property_exists($value, 'lat')) {
                $lat = $value->lat;
            } elseif (property_exists($value, 'latitude')) {
                $lat = $value->latitude;
            } else {
                $this->setLastErrorMessage('Missing property for "lat" or "latitude"');
                return false;
            }

            // find the longitude value
            if (property_exists($value, 'lon')) {
                $lon = $value->lon;
            } elseif (property_exists($value, 'longitude')) {
                $lon = $value->longitude;
            } else {
                $this->setLastErrorMessage('Missing property for "lon" or "longitude"');
                return false;
            }

            if ($this->_requiresHorizontalAccuracy === true) {
                if (property_exists($value, 'accuracy_horizontal')) {
                    $accuracyHorizontal = $value->accuracy_horizontal;
                } else {
                    $this->setLastErrorMessage('Missing property for "accuracy_horizontal"');
                    return false;
                }
            }
        }
        elseif (is_array($value))
        {
            // find the latitude value
            if (array_key_exists('lat', $value)) {
                $lat = $value['lat'];
            } elseif (array_key_exists('latitude', $value)) {
                $lat = $value['latitude'];
            } else {
                $this->setLastErrorMessage('Missing property for "lat" or "latitude"');
                return false;
            }

            // find the longitude value
            if (array_key_exists('lon', $value)) {
                $lon = $value['lon'];
            } elseif (array_key_exists('longitude', $value)) {
                $lon = $value['longitude'];
            } else {
                $this->setLastErrorMessage('Missing property for "lon" or "longitude"');
                return false;
            }

            if ($this->_requiresHorizontalAccuracy === true) {
                if (array_key_exists('accuracy_horizontal', $value)) {
                    $accuracyHorizontal = $value['accuracy_horizontal'];
                } else {
                    $this->setLastErrorMessage('Missing property for "accuracy_horizontal"');
                    return false;
                }
            }
        } else {
            $this->setLastErrorMessage('Unrecognised structure for item');
            return false;
        }

        $latValidator = new NumericRange(array('min' => -90, 'max' => 90));
        $lonValidator = new NumericRange(array('min' => -180, 'max' => 180));

        if ($latValidator->isValid($lat) === false) {
            $this->setLastErrorMessage('Latitude failed to validate as a numeric value between the range -90 to 90');
            return false;
        }

        if ($lonValidator->isValid($lon) === false) {
            $this->setLastErrorMessage('Longitude failed to validate as a numeric value between the range -180 to 180');
            return false;
        }

        if ($this->_requiresHorizontalAccuracy === true) {

            if ($accuracyHorizontal === null) {
                $this->setLastErrorMessage('Missing value for "accuracy_horizontal"');
                return false;
            }

            $accuracyHorizontalValidator = new NumericRange(array('min' => -100000, 'max' => 100000));
            if ($accuracyHorizontalValidator->isValid($accuracyHorizontal) === false) {
                $this->setLastErrorMessage('Horizontal accuracy failed to validate as a numeric value between the range -100000 to 100000: "' . (string)$accuracyHorizontal . '"');
                return false;
            }

            if ($accuracyHorizontal < 0) {
                error_log('Horizontal accuracy is less than 0: " ' . (string)$accuracyHorizontal . '"');
            }
        }

        return true;
    }
}