<?php

if ( ! function_exists("raw")) {
    /**
     * @param mixed $value
     * @return PhpPackages\Container\Raw
     */
    function raw($value)
    {
        return new PhpPackages\Container\Raw($value);
    }
}

if ( ! function_exists("container")) {
    /**
     * @return PhpPackages\Container\Container
     */
    function container()
    {
        static $container;

        if ( ! ($container instanceof PhpPackages\Container\Container)) {
            $container = new PhpPackages\Container\Container;
        }

        return $container;
    }
}
