<?php namespace PhpPackages\Container;

use ReflectionClass;

class Container
{

    /**
     * The container bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * Binds given value into the container.
     *
     * @param string $binding
     * @param mixed $value
     * @return void
     */
    public function bind($binding, $value)
    {
        $callback = function() use($value) {
            return $this->make($value);
        };

        $callback->bindTo($this);

        $this->bindings[$binding] = $callback;
    }

    /**
     * Resolves the given class' dependencies.
     *
     * @param string|mixed $class
     * @param array $dependencies
     * @throws Exceptions\ClassDoesNotExistException
     * @throws Exceptions\ClassIsNotInstantiableException
     * @throws Exceptions\ResolutionException
     * @return mixed
     */
    public function make($class, array $dependencies = [])
    {
        if ($class instanceof Raw) {
            return $class->getValue();
        }

        if ( ! is_string($class)) {
            return $class;
        }

        if (array_key_exists($class, $this->bindings)) {
            return $this->bindings[$class]();
        }

        if ( ! class_exists($class)) {
            throw new Exceptions\ClassDoesNotExistException($class);
        }

        $reflector = new ReflectionClass($class);

        $isInstantiable =
            is_null($reflector->getConstructor()) ?: $reflector->getConstructor()->isPublic();

        if ($reflector->isAbstract() or ! $isInstantiable) {
            throw new Exceptions\ClassIsNotInstantiableException($class);
        }

        if (count($dependencies) > 0) {
            return $reflector->newInstanceArgs(array_map([$this, "make"], $dependencies));
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
                $dependencies[] = $this->make($parameter["value"]);
            }
        }

        return $this->inject($reflector->newInstanceArgs($dependencies));
    }

    /**
     * Looks for @shouldBeInjected flags in properties' annotations and injects @var values.
     *
     * @param object $instance
     * @return object
     */
    public function inject($instance)
    {
        $reflector = new ReflectionClass($instance);

        foreach ($reflector->getProperties() as $property) {
            /**
             * @var \ReflectionProperty $property
             */
            $block = new DocBlock($property);

            if ( ! $block->hasFlag("shouldBeInjected")) {
                continue;
            }

            if ( ! is_null($class = $block->getValue("var"))) {
                $property->setAccessible(true);
                $property->setValue($instance, $this->make($class));
            }
        }

        return $instance;
    }
}
