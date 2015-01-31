<?php namespace specs\PhpPackages\Container;

class AnnotationSpec extends \PhpSpec\ObjectBehavior
{
    protected $block;

    public function let()
    {
        $this->block = (new \ReflectionClass(new DocBlockDummy))->getDocComment();
        $this->beConstructedWith($this->block);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Container\Annotation");
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

/**
 * @param value
 * @flag
 */
class DocBlockDummy
{
}
