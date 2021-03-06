# PHP Model Object Management
[![Version](https://img.shields.io/packagist/v/irfan-dahir/php-mom.svg?style=flat)](https://packagist.org/packages/irfan-dahir/php-mom) [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/php-mom.svg)](http://isitmaintained.com/project/irfan-dahir/php-mom "Average time to resolve an issue") [![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/irfan-dahir/php-mom.svg)](http://isitmaintained.com/project/irfan-dahir/php-mom "Average time to resolve an issue") [![stable](https://img.shields.io/badge/PHP-^%207.1-blue.svg?style=flat)]() [![MIT License](https://img.shields.io/github/license/irfan-dahir/php-mom.svg?style=flat)](https://img.shields.io/github/license/irfan-dahir/php-mom.svg?style=flat)

PHP-MOM is a stupid simple PHP Model object generator and helper.

## Installation
```composer require irfan-dahir/php-mom --no-dev```


## Example

```php
require_once __DIR__ . '/vendor/autoload.php';

// Create the object
$schema = \MOM\Schema::create();

// Create an object from JSON
$schema = \MOM\Schema::fromJSON("[]");

// Adding Properties
$schema->add('prop1'); // will assign value NULL
$schema->add('prop1', 5); // will assign value `5`


// PHP's default syntax
$schema->prop1 = 5;

// Bulk adding
$schema->add([
    'prop2',
    'prop3' => 5,
    'prop4' => 3.142,
    'prop5' => 'foo',
    'prop_unedit' => true
]);

// Works with pre-made models/objects too
// Only copies public properties for now
// Anonymous properties do NOT get copied (there might be a workaround)
$schema->add(new class {
    public $foo = "bar";
    public $baz = false;
});

// Removing properties
$schema->remove('prop2');

// Bulk removal
$schema->remove([
    'prop2','prop3'
]);

// PHP's default syntax
unset($schema->prop2, ...);

// Updating Properties; aka renaming
$schema->update('prop1', 'prop1_edit'); // renames `prop1` to `prop1_edit` (copies the value as well)

// Bulk update
$schema->update([
    'prop5' => 'prop5_edit',
    'prop_unedit' => 'prop_edited'
]);


// Helper Methods

$schema->toArray(); // Model to Array

$schema->toJSON(); // Model to JSON

```

### Running tests
1. `composer require irfan-dahir/php-mom --dev`
2. `composer vendor/bin/phpunit tests`

### Dependencies
- PHP 7.1+


### Issues
Please create an issue for any bugs/security risks/etc