<?php namespace specs\PhpPackages\Container;

class RawSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(123);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Raw");
    }

    public function it_returns_the_stored_value()
    {
        $this->getValue()->shouldBe(123);
    }
}
