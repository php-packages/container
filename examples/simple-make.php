<?php

require __DIR__."/../vendor/autoload.php";

use PhpPackages\Container\Container;

class Example
{
}

var_dump(
    spl_object_hash((new Container)->make("Example")),
    spl_object_hash((new Container)->make(new Example))
);
