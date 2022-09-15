<?php

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
}
