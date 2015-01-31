<?php namespace PhpPackages;

class Annotation
{

    /**
     * Parses a DocBlock comment into an array of lines.
     *
     * @param string $annotation
     * @return array
     */
    public function parseBlock($annotation)
    {
        $lines = array_filter(array_map(function($line)
        {
            $line = trim($line);

            if (strpos($line, "/**") !== false or strpos($line, "*/") !== false) {
                return null;
            }

            return trim(substr($line, 1));
        }, explode(PHP_EOL, $annotation)));

        return array_values($lines);
    }
}
