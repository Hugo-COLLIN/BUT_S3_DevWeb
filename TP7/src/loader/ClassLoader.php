<?php

namespace loader;
class ClassLoader
{
    protected string $prefix;
    protected string $dir;

    function __construct(string $prefix, string $dir)
    {
        $this->prefix = $prefix;
        $this->dir = $dir;
        $this->loadClass();
    }

    function loadClass () : void
    {
        $splitted = explode("/", $this->dir);
        $namespace = $this->prefix;
        $i = 0;
        foreach ($splitted as $part)
        {
            if ($i >= 2)
                $namespace .= $part . "\\";
            $i ++;
        }
        print $namespace;

        //if (if_file($this->dir)) require_once $this->dir;
    }

    function register () : void
    {
        spl_autoload_register($this);
    }
}