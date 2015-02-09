<?php namespace specs\PhpPackages\Container;

use stdClass, ReflectionClass, TypeHintClass;

class TypeHintSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(new ReflectionClass(new TypeHintClass([])));
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

    public function it_returns_an_empty_array_if_the_class_has_no_constructor()
    {
        $this->beConstructedWith(new ReflectionClass(new stdClass));
        $this->read()->shouldBe([]);
    }
}
