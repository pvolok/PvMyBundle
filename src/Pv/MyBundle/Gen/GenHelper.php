<?php

namespace Pv\MyBundle\Gen;

class GenHelper
{
    private $root;

    public function __construct($root)
    {
        $this->root = $root;
    }

    public function read($path)
    {
        $path = $this->getPath($path);
        return is_file($path) ? file_get_contents($path) : null;
    }

    public function write($path, $data)
    {
        $path = $this->getPath($path);
        $dir = dirname($path);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($path, $data);
    }

    public function exists($path)
    {
        return file_exists($this->getPath($path));
    }

    public function getPath($path)
    {
        $path = trim($path, '/');

        return "$this->root/$path";
    }
}
