Validators
==========

A collection of many validators.

Testing:
--------

```
$ composer install
$ ./vendor/bin/phpunit
```

Adapters:
---------

* `EmailAddress` - Validate an email address format.
    * ```php
      <?php
      // Simple format check:
      $adapter = new \District5\Validator\EmailAddress();
      $adapter->isValid('foo@gmail.com'); // returns true
      
      // Deeper check, which includes MX record lookup:
      $adapter = new \District5\Validator\EmailAddress(
          ['deep' => true]
      );
      $adapter->isValid('foo@gmail.com'); // returns true
      ```
