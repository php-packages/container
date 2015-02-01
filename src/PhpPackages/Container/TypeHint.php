<?php namespace PhpPackages\Container;

use ReflectionClass;

class TypeHint
{

    /**
     * @var ReflectionClass
     */
    protected $reflector;

    /**
     * @param ReflectionClass $reflector
     * @return TypeHint
     */
    public function __construct(ReflectionClass $reflector)
    {
        $this->reflector = $reflector;
    }

    /**
     * Reads the constructor's type-hints.
     *
     * @return array
     */
    public function read()
    {
    }
}
