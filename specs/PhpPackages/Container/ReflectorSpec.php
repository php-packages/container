<?php namespace specs\PhpPackages\Container;

class ReflectorSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(new \ReflectionClass(new PropertyDummy));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Reflector");
    }

    public function it_returns_properties_that_the_given_class_has()
    {
        $this->getProperties()->shouldBeArray();
        $this->getProperties()->shouldNotBe([]);
        $this->getProperties()->shouldAllBeAnInstanceOf("ReflectionProperty");
    }

    public function getMatchers()
    {
        return [
            "allBeAnInstanceOf" => function(array $subjects, $className)
            {
                foreach ($subjects as $subject) {
                    if ( ! $subject instanceof $className) {
                        return false;
                    }
                }

                return true;
            },
        ];
    }
}

class PropertyDummy
{

    protected $property;

    protected $anotherProperty;
}
