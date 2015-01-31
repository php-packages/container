<?php namespace PhpPackages\Container;

class Annotation
{

    /**
     * @var array
     */
    protected $lines = [];

    /**
     * Whether the array of lines we are working with contains the given flag.
     *
     * @param string $name
     * @return boolean
     */
    public function hasFlag($name)
    {
        return in_array("@".$name, $this->lines);
    }

    /**
     * Parses the given DocBlock and assigns the produced array to a property.
     *
     * @param string $block
     * @return void
     */
    public function setBlock($block)
    {
        $this->lines = $this->parseBlock($block);
    }

    /**
     * Returns the array of lines we are working with.
     *
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * Parses a DocBlock comment into an array of lines.
     *
     * @param string $annotation
     * @return array
     */
    protected function parseBlock($annotation)
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
