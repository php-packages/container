<?php

require __DIR__."/../vendor/autoload.php";

use PhpPackages\Container\Container;

class SubExample
{
}

class Example
{

    /**
     * @shouldBeInjected
     * @var SubExample
     */
    public $foo;

    /**
     * @var array
     */
    public $bar = [];
}

$example = (new Container)->make("Example");

var_dump(spl_object_hash($example->foo), $example->bar);
