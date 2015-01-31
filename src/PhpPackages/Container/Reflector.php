<?php namespace PhpPackages\Container;

use Reflector as ReflectorInterface;

class Reflector
{

    /**
     * @var ReflectorInterface
     */
    protected $instance;

    /**
     * @param ReflectorInterface $instance
     * @return Reflector
     */
    public function __construct(ReflectorInterface $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Returns an array of \ReflectionProperty instances (may be empty).
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->instance->getProperties();
    }
}
