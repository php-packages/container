<?php namespace specs\PhpPackages\Container;

class TypeHintSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\TypeHint");
    }
}
