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
        if (is_null($constructor = $this->reflector->getConstructor())) {
            return [];
        }

        $parameters = [];

        foreach ($constructor->getParameters() as $reflectionParameter) {
            /**
             * @var \ReflectionParameter $parameter
             */

            $parameter = [
                "isClass"         => ! is_null($reflectionParameter->getClass()),
                "hasDefaultValue" => $reflectionParameter->isDefaultValueAvailable(),
            ];

            if ($parameter["isClass"]) {
                $parameter["value"] = $reflectionParameter->getClass()->getName();
            }

            if ($parameter["hasDefaultValue"]) {
                $parameter["defaultValue"] = $reflectionParameter->getDefaultValue();
            }

            $parameters[] = $parameter;
        }

        return $parameters;
    }
}
