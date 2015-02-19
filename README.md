## Container [![Build Status](https://travis-ci.org/php-packages/container.svg?branch=master)](https://travis-ci.org/php-packages/container)

An IoC container for PHP: simple, fast, clean.

### Features

- injecting via type-hinting
- injecting via property annotations
- manual dependencies injecting via an array

## Navigation

- [Installation](#installation)
- [Usage](#usage)
- [Development](#development)
- [Additional information](#additional-information)

## Installation

```shell
composer require php-packages/container
```

## Usage

### mixed make(string|mixed $class, array $dependencies = [])

```php
class A
{
}

get_class(container()->make("A")); # => "A"
get_class(container()->make(new A)); # => "A"

class B
{

    public function __construct(array $foo = [], A $bar)
    {
        var_dump($foo); # => []
        get_class($bar); # => "A"
    }
}

container()->make("B");

class C
{

    public function __construct(array $foo)
    {
        var_dump($foo); # => [1, 2, "C"]
    }
}

container()->make("C", [[1, 2, raw("C")]]);
```

### object inject(object $instance)

The `inject` method be always called inside of `make`.

```php
class C
{
}

class A
{

    /**
     * @shouldBeInjected
     * @var C
     */
    public $b;
}

get_class(container()->inject(new A)->b); # => "C"
```

### void bind(string $binding, string|object $value)

```php
container()->bind("foo", "stdClass");
container()->bind("bar", $bar = new stdClass);

var_dump(container()->make("foo")); # => an instance of stdClass
var_dump(container()->make("bar") === container()->make("bar")); # => true
```

## Development

```shell
make run-tests
make coverage-report coverage-report-server
```

## Additional information

*Container* is released under the MIT license.
