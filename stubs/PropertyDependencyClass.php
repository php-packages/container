<?php

class PropertyDependencyClass
{

    /**
     * @shouldBeInjected
     * @var DependingOnResolvableClass
     */
    public $foo;

    /**
     * @var ResolvableClass
     * @shouldBeInjected
     */
    protected $bar;

    /**
     * @var stdClass
     */
    private $baz;

    public function __destruct()
    {
        if (( ! $this->foo instanceof DependingOnResolvableClass)
            or ( ! $this->bar instanceof ResolvableClass)
            or ($this->baz instanceof stdClass)) {
            throw new RuntimeException("The dependencies were NOT injected properly.");
        }
    }
}
