[![codecov](https://codecov.io/gh/district-5/php-validators/graph/badge.svg?token=E225X7GK00)](https://codecov.io/gh/district-5/php-validators)
# Validators
A collection of validators implementing / extending the [District5 Validator](https://github.com/district-5/php-validator) library.

## Installation
Install using composer:
```bash
composer require district5/validators
```

## Usage
### Currently Available Validators
* Array of Numbers
* Bool Value
* Checkbox Value
* DateTime
* DateYYYMMDD
* Domain Name
* Email Address
* Hex
* Hex Colour
* Integer Value
* Integer Positive
* Integer Range
* JSON String
* Lat Lon Object
* Long Value
* Numeric Value
* Numeric Range
* Numeric Specific Values
* Regex
* Std Class with Properties
* String in Array of String
* String Length
* String of Defined Characters
* String Version Major Minor Patch Greater Than or Equal To
* String with Dashes
* String with Dashes and Underscores
* String with Dashes Dots and Underscores
* Sub Domain
* Unix Timestamp Seconds
* URL

### General
Most validators work in the same way:

```php
$validValue = true;
$invalidValue = 'Hello';

$validator = new \District5\Validators\BoolValue();

$validator->isValid($validValue);   // true
$validator->isValid($invalidValue);   // false
```

Some validators have configuration options that can be specified at construction time:

### EmailAddress
Validate an email address:

```php
<?php
// Simple format check:
$validator = new \District5\Validators\EmailAddress();
$validator->isValid('foo@gmail.com'); // true

// Deeper check, which includes MX record lookup:
$validator = new \District5\Validators\EmailAddress(
    ['deep' => true]
);

$validator->isValid('foo@gmail.com'); // true
$validator->isValid('foo@domainthatdoesntexist.com'); // false
```

## Testing:
```
$ composer install
$ ./vendor/bin/phpunit
```