<?php

class PlayList
{
    addTrack(AudioTrack $track) : void
{
    array_push($this->tracklist, $track);
    $this->nbPiste ++;
    $this->dureeTot += isset(track->duree) ? $track->duree : 0;
}

removeTrack
    unset()
}