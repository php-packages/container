<?php namespace specs\PhpPackages\Container;

class TypeHintSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(new \ReflectionClass(new TypeHintDummy([])));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\TypeHint");
    }

    public function it_reads_typehints()
    {
        $this->read()->shouldBe([
            [
                "isClass"         => false,
                "hasDefaultValue" => false,
            ],
            [
                "isClass"         => true,
                "hasDefaultValue" => true,
                "value"           => "stdClass",
                "defaultValue"    => null,
            ],
        ]);
    }
}

class TypeHintDummy
{

    public function __construct(array $foo, \stdClass $bar = null)
    {
    }
}
