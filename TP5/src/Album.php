<?php

class Album extends AudioList
{
    $artisteAlbum
$dateSortie

public function __construct($nom, $initiallist)
{
    parent::_construct($nom, $initialList)
}


    /**
     * @throws \exceptions\InvalidPropertyNameException
     * @throws \exceptions\NotEditablePropertyException
     */
    public function __set($name, $value)
{
    if (!property_exists($this, $attname))
        throw new \exceptions\InvalidPropertyNameException();
    if ($name ==='artistealbum' || $name === 'datesortie')
        throw new \exceptions\NotEditablePropertyException();
}
}