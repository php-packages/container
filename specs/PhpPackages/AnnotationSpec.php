<?php namespace specs\PhpPackages;

class AnnotationSpec extends \PhpSpec\ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType("PhpPackages\Annotation");
    }
}
