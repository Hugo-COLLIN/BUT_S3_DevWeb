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
    }

    function loadClass (string $classname) : void
    {
        //echo 'ClassLoader::loadclass : ' . $classname;

        if (!(str_starts_with($classname, $this->prefix)))
            return;
        $chemin_fichier = str_replace($this->prefix, $this->dir, $classname);
        $tab = explode("\\", $chemin_fichier);
        $chemin_fichier = implode("/", $tab);
        $chemin_fichier .= ".php";
        if (is_file($chemin_fichier)) require_once $chemin_fichier;
        //print($chemin_fichier);
        //var_dump($tab);
        /*
        if (!$classname begin $this->prefix)
            return;

        $chemin_fichier = remplacer $this->prefix par $this->root dans $classname
        $chemin_fichier = remplacer '\\' par DIRECTORY_SEPARATOR dans chemin_fichier
        ajouter ".php" à la fin de $chemin_fichier

        si (fichier_existe($chemin_fichier)) alors require_once $chemin_fichier;
        */
    }

















/*

    function loadClass (string $classname) : void
    {
        $splitted = explode("/", $classname);
        $res = str_replace($this->dir, $this->prefix, $classname);
        print $res;


*/
















        /*
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
        */
    //}

    function register () : void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
}