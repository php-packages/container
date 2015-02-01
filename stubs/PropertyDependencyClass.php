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
        if ( ! $this->foo or ! $this->bar or $this->baz) {
            throw new RuntimeException("The dependencies were NOT injected properly.");
        }
    }
}
