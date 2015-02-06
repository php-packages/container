<?php namespace specs\PhpPackages\Container;

class RawSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Raw");
    }
}
