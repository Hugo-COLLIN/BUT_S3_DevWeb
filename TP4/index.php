<?php

class AlbumTrack0
{
    //Attributes
    public string $titre;
    public string $artiste;
    public string $album;
    public string $annee;
    public int $numPiste;
    public string $genre;
    public int $duree;
    public string $nomAudio;

    //Methods
    public function __construct(string $t, string $ar, string $al, string $an, int $nP, string $g, int $d, string $nA)
    {
        $this->titre = $t;
        $this->artiste = $ar;
        $this->album = $al;
        $this->annee = $an;
        $this->numPiste = $nP;
        $this->genre = $g;
        $this->duree = $d;
        $this->nomAudio = $nA;
    }

}
