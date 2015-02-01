## Container

An IoC container for PHP: simple, fast, clean.

## Navigation

- [Installation](#installation)
- [Usage](#usage)
- [Additional information](#additional-information)

## Installation

TBW (To Be Written).

## Usage

*First (raw) draft:*

```php
$container = new PhpPackages\Container();

class A
{

    /**
     * @var B
     * @shouldBeInjected
     */
    protected $b;

    public function __construct($d)
    {
    }
}

class B
{

    public function __construct(C $c)
    {
    }
}

class C
{
}

class D
{
}

$container->make("A", ["D"]); // => a new instance of A with all dependencies resolved.
```

### Features

- Injecting via type-hinting.
- Injecting via annotations.
- Manual dependencies injecting (via an array).

## Additional information

*Container* is released under the MIT license.
