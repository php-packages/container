<?php namespace PhpPackages\Container;

class Container
{

    /**
     * Resolves the given class' dependencies.
     *
     * @param string $class
     * @param array $dependencies
     * @throws Exceptions\ClassDoesNotExistException
     * @throws Exceptions\ClassIsNotInstantiableException
     * @return mixed
     */
    public function make($class, array $dependencies = [])
    {
        if ( ! class_exists($class)) {
            throw new Exceptions\ClassDoesNotExistException($class);
        }

        $reflector = new \ReflectionClass($class);

        $isInstantiable =
            $reflector->getConstructor()->isPublic() or is_null($reflector->getConstructor());

        if ($reflector->isAbstract() or ! $isInstantiable) {
            throw new Exceptions\ClassIsNotInstantiableException($class);
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}
