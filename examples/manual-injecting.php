<?php

require __DIR__."/../vendor/autoload.php";

use PhpPackages\Container\Container;

class SubExample1
{
}

class SubExample2
{
}

class Example
{

    public function __construct(SubExample1 $foo, SubExample2 $bar)
    {
        var_dump(spl_object_hash($foo), spl_object_hash($bar));
    }
}

(new Container)->make("Example", [new SubExample1, "SubExample2"]);
