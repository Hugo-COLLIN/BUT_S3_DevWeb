<?php

class PlayList extends AudioList
{
    public function __construct(string $nom, array $initialList = [])
    {
        parent::__construct($nom, $initialList);
    }

    public function addTrack(AudioTrack $track) : void
    {
        array_push($this->tracklist, $track);
        $this->nbPiste ++;
        $this->dureeTot += isset($track->duree) ? $track->duree : 0;
    }

    public function removeTrack(int $indice) : void
    {
        unset($this->tracklist[$indice]);
    }

    public function addTrackList(array $tracks) : void
    {
        $this->tracklist = array_merge($this->tracklist, $tracks);
        $this->nbPiste += sizeof($tracks);

        foreach ($tracks as $t)
            $this->dureeTot += isset($t->duree) ? $t->duree : 0;
    }
}