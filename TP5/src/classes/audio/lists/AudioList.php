<?php
namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\exception\InvalidPropertyNameException;

class AudioList
{
    protected string $nom;
    protected array $tracklist = [];
    protected int $nbPiste = 0;
    protected int $dureeTot = 0;

    public function __construct(string $lName, array $initialList = [])
    {
        $this->nom = $lName;
        $this->tracklist = $initialList;
        $this->nbPiste = count($this->tracklist);
        foreach($this->tracklist as $track)
            $this->dureeTot += $track->duree;
    }

    public function __get(string $name) : mixed
    {
        if (!property_exists($this, $name))
            throw new InvalidPropertyNameException();
        return $this->$name;
    }
}