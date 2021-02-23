# Validators
A collection of validators implementing / extending the [District5 Validator](https://github.com/district-5/php-validator) library.

## Installation
Install using composer:
```bash
composer require district5/validators
```

## Usage
### General
Most validator work in the same way:
```php
$validValue = true;
$invalidValue = 'Hello';

$validator = new \District5\Validator\BoolValue();

$validator->isValid($validValue);   // true
$validator->isValid($invalidValue);   // false
```

Some validators have configuration options that can be specified at construction time:

### EmailAddress
Validate an email address:
```php
<?php
// Simple format check:
$validator = new \District5\Validator\EmailAddress();
$validator->isValid('foo@gmail.com'); // true

// Deeper check, which includes MX record lookup:
$validator = new \District5\Validator\EmailAddress(
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