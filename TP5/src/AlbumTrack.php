<?php
//Att protected pour etre visible par le getter et setter de AudioTrack
class AlbumTrack extends AudioTrack
{
    //Attributes
    protected string $album;
    protected int $numPiste;
    //public int $annee_parution; //auteur

    //Methods
    public function __construct(string $t, string $c)
    {
        parent::__construct($t, $c);
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
