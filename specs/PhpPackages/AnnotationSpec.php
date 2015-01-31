<?php namespace specs\PhpPackages;

class AnnotationSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Annotation");
    }

    public function it_parses_a_docblock_comment()
    {
        $this->parseBlock((new \ReflectionClass(new Dummy))->getDocComment())
             ->shouldBe(["@param value", "@flag"]);
    }
}

/**
 * @param value
 * @flag
 */
class Dummy
{
}
