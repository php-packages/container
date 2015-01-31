<?php namespace specs\PhpPackages\Container;

class AnnotationSpec extends \PhpSpec\ObjectBehavior
{
    protected $block;

    public function let()
    {
        $this->block = (new \ReflectionClass(new Dummy))->getDocComment();
        $this->setBlock($this->block)->shouldBe(null);
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
}

/**
 * @param value
 * @flag
 */
class Dummy
{
}
