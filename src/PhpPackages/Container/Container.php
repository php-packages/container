<?php namespace PhpPackages\Container;

class Container
{

    /**
     * Resolves the given class' dependencies.
     *
     * @param string $class
     * @param array $dependencies
     * @throws Exceptions\ClassDoesNotExistException
     * @return mixed
     */
    public function make($class, array $dependencies = [])
    {
        if ( ! class_exists($class)) {
            throw new Exceptions\ClassDoesNotExistException($class);
        }
    }
}
