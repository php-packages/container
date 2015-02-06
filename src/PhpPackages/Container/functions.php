<?php // @codeCoverageIgnoreStart

if ( ! function_exists("raw")) {
    function raw($value)
    {
        return new PhpPackages\Container\Raw($value);
    }
}
