<?php namespace PhpPackages\Container;

class DocBlock
{

    /**
     * @var array
     */
    protected $lines = [];

    /**
     * @param \Reflector $reflector
     * @return DocBlock
     */
    public function __construct(\Reflector $reflector)
    {
        $this->setBlock($reflector->getDocComment());
    }

    /**
     * Returns a value associated with the given key, or null otherwise (if no such key).
     *
     * @param string $key
     * @return string|null
     */
    public function getValue($key)
    {
        foreach ($this->lines as $line) {
            if (strpos($line, "@".$key) === 0) {
                return trim(str_replace("@".$key, "", $line));
            }
        }

        return null;
    }

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
    protected function setBlock($block)
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
     * @param string $block
     * @return array
     */
    protected function parseBlock($block)
    {
        $lines = array_filter(array_map(function($line)
        {
            $line = trim($line);

            if (strpos($line, "/**") !== false or strpos($line, "*/") !== false) {
                return null;
            }

            return trim(substr($line, 1));
        }, explode(PHP_EOL, $block)));

        return array_values($lines);
    }
}
