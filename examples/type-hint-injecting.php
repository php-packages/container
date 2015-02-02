<?php

require __DIR__."/../vendor/autoload.php";

use PhpPackages\Container\Container;

class SubExample
{
}

class Example
{

    public function __construct(SubExample $foo)
    {
        var_dump(spl_object_hash($foo));
    }
}

(new Container)->make("Example");
