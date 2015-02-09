<?php namespace specs\PhpPackages\Container;

use ReflectionClass, DocBlockClass;

class DocBlockSpec extends \PhpSpec\ObjectBehavior
{

    public function let()
    {
        $this->beConstructedWith(new ReflectionClass(new DocBlockClass));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\DocBlock");
    }

    public function it_parses_a_docblock_comment()
    {
        $this->getLines()->shouldBe(["@param value", "@flag"]);
    }

    public function it_returns_true_if_a_flag_exists_otherwise_false()
    {
        $this->hasFlag("notAFlag")->shouldBe(false);
        $this->hasFlag("flag")->shouldBe(true);
    }

    public function it_returns_a_value_associated_with_the_given_key_if_it_exists_or_null()
    {
        $this->getValue("nonexistentParam")->shouldBe(null);
        $this->getValue("param")->shouldBe("value");
    }
}
