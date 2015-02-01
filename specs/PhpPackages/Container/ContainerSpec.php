<?php namespace specs\PhpPackages\Container;

class ContainerSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Container");
    }

    public function it_resolves_dependencies()
    {
        // Scenario #1: the passed class name was not registered.
        $this->shouldThrow("PhpPackages\Container\Exceptions\ClassDoesNotExistException")
             ->duringMake("Class".uniqid());

        // Scenario #2: the passed class is not instantiable.
        $this->shouldThrow("PhpPackages\Container\Exceptions\ClassIsNotInstantiableException")
             ->duringMake("specs\PhpPackages\Container\NotInstantiableClass");
    }
}

abstract class NotInstantiableClass
{

    private function __construct()
    {
    }
}
