<?php
namespace iutnc\deefy\audio\lists;
//namespace VENDOR\PROJECT\Module-Sous-partie

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\NotEditablePropertyException;

class AlbumList extends AudioList
{
    protected string $artisteAlbum;
    protected string $dateSortie;

    public function __construct(string $nom, array $initialList)
    {
        parent::__construct($nom, $initialList);
    }


    /**
     * @throws InvalidPropertyNameException
     * @throws NotEditablePropertyException
     */
    public function __set(string $name, mixed $value) : void
    {
        if (!property_exists($this, $name))
            throw new InvalidPropertyNameException();
        if ($name ==='artisteAlbum' || $name === 'dateSortie')
            $this->$name = $value;
        else
            throw new NotEditablePropertyException();
    }
}