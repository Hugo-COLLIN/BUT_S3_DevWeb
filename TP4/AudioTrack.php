<?php

class AudioTrack
{
    //Attributes
    public string $titre;
    public string $auteur;
    public int $annee;
    public int $genre;
    public int $duree = 0;
    public string $nomAudio;
    public string $cheminfichier;

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
}