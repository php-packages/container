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
    }
}
