<?php

class AudioList
{
    $nom
$tracklist = []
$nbPiste = 0
$dureetotale = 0
    public function __construct(string $lName, array $ititialList = [])
    {
        $this->nom = $lName;
        $this->tracklist = $initialList;
            $this->nbPiste = count($this->tracklist);
        foreach($this->tracklist as $track)
            $this->dureeTot += $track->duree;
    }

    public function __get(string $name) : mixed
    {
        if (! property_exists())
            throw new \exceptions\InvalidPropertyNameException();
        return $this->$name;
    }
}