<?php namespace specs\PhpPackages\Container;

class ContainerSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Container");
    }
}
