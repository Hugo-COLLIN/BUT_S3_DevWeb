<?php

class AlbumTrack
{
    //Attributes
    public string $titre;
    public string $artiste;
    public string $album;
    public int $annee;
    public int $numPiste;
    public int $genre;
    public int $duree;
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
        //return json_encode($this->titre) . "\n" . json_encode($this->cheminfichier);
        return json_encode($this); //JSON_PRETTY_PRINT
    }
}
