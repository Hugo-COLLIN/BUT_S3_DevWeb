<?php
namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;

class PlayList extends AudioList
{
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
        $this->tracklist = array_unique(array_merge($this->tracklist, $tracks), SORT_REGULAR);
        $this->nbPiste = count($this->tracklist); //$this->nbPiste += sizeof($tracks);

        //foreach ($tracks as $t) $this->dureeTot += isset($t->duree) ? $t->duree : 0;
        foreach ($this->tracklist as $item)
            $this->dureeTot += $item->duree;

    }
}