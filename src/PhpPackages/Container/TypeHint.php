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

        $typeHints = [];

        foreach ($constructor->getParameters() as $parameter) {
            /**
             * @var \ReflectionParameter $parameter
             */

            $typeHint = [
                "isClass" => ! is_null($parameter->getClass()),
                "hasDefaultValue" => $parameter->isDefaultValueAvailable(),
            ];

            if ($typeHint["isClass"]) {
                $typeHint["value"] = $parameter->getClass()->getName();
            }

            if ($typeHint["hasDefaultValue"]) {
                $typeHint["defaultValue"] = $parameter->getDefaultValue();
            }

            $typeHints[] = $typeHint;
        }

        return $typeHints;
    }
}
