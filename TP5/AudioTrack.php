<?php

class AudioTrack
{
    //Attributes
    protected string $titre;
    protected string $auteur;
    protected int $annee;
    protected int $genre;
    protected int $duree = 0;
    protected string $nomAudio;
    protected string $cheminfichier;

    //Methods
    public function __construct(string $t, string $c)
    {
        $this->titre = $t;
        $this->cheminfichier = $c;
    }

    public function __toString()
    {
        return json_encode($this); //JSON_PRETTY_PRINT
    }

    public function __get(string $att)
    {
        if (property_exists($this, $att)) return $this->$att;
        throw new Exception("$att : Invalid property");
    }
    public function __set(string $att, $value): void
    {
        if (property_exists($this, $att)) $this->$att = $value;
        else throw new Exception("$att : Invalid property");
    }
}