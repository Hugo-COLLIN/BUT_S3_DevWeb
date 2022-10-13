<?php

namespace loader;
class ClassLoader
{
    protected string $prefix;
    protected string $dir;

    function __construct(string $prefix, string $dir)
    {
        $this->prefix = $prefix;
        $this->dir = $dir . "/";
    }

    function loadClass (string $classname) : void
    {
        //echo 'ClassLoader::loadclass : ' . $classname . "<br>";

        if (!(str_starts_with($classname, $this->prefix)))
            return;

        $chemin_fichier = str_replace($this->prefix, $this->dir, $classname);
        $tab = explode("\\", $chemin_fichier);
        $chemin_fichier = implode("/", $tab);
        $chemin_fichier .= ".php";

        if (is_file($chemin_fichier)) require_once $chemin_fichier;
        //print($chemin_fichier);
        //var_dump($tab);
    }

    function register () : void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
}