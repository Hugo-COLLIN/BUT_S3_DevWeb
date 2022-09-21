<?php

class Album extends AudioList
{
    protected string $artisteAlbum;
    protected string $dateSortie;

public function __construct(string $nom, array $initialList = [])
{
    parent::_construct($nom, $initialList);
}


    /**
     * @throws \exceptions\InvalidPropertyNameException
     * @throws \exceptions\NotEditablePropertyException
     */
    public function __set(string $name, mixed $value) : void
    {
        if (!property_exists($this, $name))
            throw new \exceptions\InvalidPropertyNameException();
        if ($name ==='artistealbum' || $name === 'datesortie')
            $this->$name = $value;
        else
            throw new \exceptions\NotEditablePropertyException();

    }
}