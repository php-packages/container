<?php namespace PhpPackages\Container;

use ReflectionClass;

class Container
{

    /**
     * Resolves the given class' dependencies.
     *
     * @param string $class
     * @param array $dependencies
     * @throws Exceptions\ClassDoesNotExistException
     * @throws Exceptions\ClassIsNotInstantiableException
     * @throws Exceptions\ResolutionException
     * @return mixed
     */
    public function make($class, array $dependencies = [])
    {
        if ( ! class_exists($class)) {
            throw new Exceptions\ClassDoesNotExistException($class);
        }

        $reflector = new ReflectionClass($class);

        $isInstantiable = ! is_null($reflector->getConstructor()) and
            $reflector->getConstructor()->isPublic();

        if ($reflector->isAbstract() or ! $isInstantiable) {
            throw new Exceptions\ClassIsNotInstantiableException($class);
        }

        if (count($dependencies) > 0) {
            return $reflector->newInstanceArgs($dependencies);
        }

        if ( ! $resolved = $this->attemptToResolve($reflector)) {
            throw new Exceptions\ResolutionException($class);
        }

        return $resolved;
    }

    /**
     * Attempts to resolve ALL dependencies (in the constructor AND property annotations).
     *
     * @param ReflectionClass $reflector
     * @return boolean|object
     */
    protected function attemptToResolve(ReflectionClass $reflector)
    {
        $dependencies = [];

        foreach ((new TypeHint($reflector))->read() as $parameter) {
            if ( ! $parameter["isClass"]) {
                if ( ! $parameter["hasDefaultValue"]) {
                    return false;
                }

                $dependencies[] = $parameter["defaultValue"];
            } else {
                $dependencies[] = new $parameter["value"];
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}
