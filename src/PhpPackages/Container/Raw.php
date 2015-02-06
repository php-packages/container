<?php namespace PhpPackages\Container;

class Raw
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     * @return Raw
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
