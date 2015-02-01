<?php namespace specs\PhpPackages\Container;

use stdClass, ReflectionClass;

class TypeHintSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(new ReflectionClass(new TypeHintDummy([])));
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

    public function it_smth()
    {
        $this->beConstructedWith(new ReflectionClass(new stdClass));
        $this->read()->shouldBe([]);
    }
}

class TypeHintDummy
{

    public function __construct(array $foo, stdClass $bar = null)
    {
    }
}
