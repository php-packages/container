## Container [![Build Status](https://travis-ci.org/php-packages/container.svg?branch=master)](https://travis-ci.org/php-packages/container)

An IoC container for PHP: simple, fast, clean.

### Features

- Injecting via type-hinting.
- Injecting via annotations.
- Manual dependencies injecting (via an array).

## Navigation

- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Additional information](#additional-information)

## Installation

```shell
composer require php-packages/container
```

## Usage

```php
$container = new \PhpPackages\Container\Container;
```

### mixed make(string|mixed $class, array $dependencies = [])

```php
class A
{
}

get_class($container->make("A")); # => "A"
get_class($container->make(new A)); # => "A"

class B
{

    public function __construct(array $foo = [], A $bar)
    {
        get_class($bar); # => "A"
    }
}

$container->make("B");
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

get_class($container->inject(new A)->b); # => "C"
```

## Testing

```shell
git clone https://github.com/php-packages/container.git; cd container
composer install --dev # or "composer update"
make run-specs boot-server # visit http://localhost:8000
```

## Additional information

*Container* is released under the MIT license.
