<?php namespace specs\PhpPackages;

class AnnotationSpec extends \PhpSpec\ObjectBehavior
{
    protected $block;

    public function let()
    {
        $this->block = (new \ReflectionClass(new Dummy))->getDocComment();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Annotation");
    }

    public function it_parses_a_docblock_comment()
    {
        $this->setBlock($this->block)->shouldBe(null);
        $this->getLines()->shouldBe(["@param value", "@flag"]);
    }
}

/**
 * @param value
 * @flag
 */
class Dummy
{
}
