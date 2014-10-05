<?php

namespace Pv\MyBundle\PageletLib;

class PageletArgs
{
    private $args = [];

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function get($name)
    {
        if (!isset($this->args[$name])) {
            throw new \Exception("Argument '$name' is not provided.");
        }
        return $this->args[$name];
    }

    public function has($name)
    {
        return isset($this->args[$name]);
    }

    public function all()
    {
        return $this->args;
    }
}
