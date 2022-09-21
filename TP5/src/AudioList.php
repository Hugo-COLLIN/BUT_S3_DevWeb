<?php

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

    /**
     * @throws \exceptions\InvalidPropertyNameException
     */
    public function __get(string $name) : mixed
    {
        if (! property_exists())
            throw new \exceptions\InvalidPropertyNameException();
        return $this->$name;
    }
}