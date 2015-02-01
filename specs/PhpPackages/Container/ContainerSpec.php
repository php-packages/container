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
             ->duringMake(uniqid()."Class");

        // Scenario #2: the passed class is not instantiable.
        $this->shouldThrow("PhpPackages\Container\Exceptions\ClassIsNotInstantiableException")
             ->duringMake("NotInstantiableClass");

        // Scenario #3: the class dependencies were passed as the second parameter.
        $this->make("TypeHintClass", [[],])->shouldHaveType("TypeHintClass");

        // Scenario #4: a failed attempt to perform the automatic resolution:
        // the default value was not specified for a primitive dependency.
        $this->shouldThrow("PhpPackages\Container\Exceptions\ResolutionException")
             ->duringMake("TypeHintClass");

        // Scenario #5: inversed #4.
        $this->make("ResolvableClass")->shouldHaveType("ResolvableClass");

        // Scenario #6: some class depends on another class that also has dependencies.
        $this->make("DependingOnResolvableClass")
             ->shouldHaveType("DependingOnResolvableClass");
    }
}
