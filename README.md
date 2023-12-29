# PHP type value wrapper

Basic OOP classes to wrap php basic types conversion behind a common interface.

## Installation

`composer require star/php-type`

## Casting value

You can use [ValueGuesser](src/ValueGuesser.php) to convert a mixed value to the object type.

```php
use Star\Component\Type\ValueGuesser;

$int = ValueGuesser::fromMixed(12);
$int->isEmpty(); // false
$int->toBool(); // true
$int->toDate(); // throws Exception
$int->toFloat(); // 12.0
$int->toInteger(); // 12
$int->toString(); // "12"
```

## Hooking into the type

When you don't know which type will be returned, the `ValueVisitor` allows you to define operations per
type (like a switch case).

```php
use Star\Component\Type\BooleanValue;
use Star\Component\Type\ValueVisitor;

$true = BooleanValue::asTrue();
$true->acceptValueVisitor(
    new class implements ValueVisitor {
        ...
        public function visitFloatValue(float $value): void {
            // do your custom operation when the value is float.
        }
        ...
    }
);
```
