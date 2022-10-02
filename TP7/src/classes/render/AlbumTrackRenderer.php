<?php
namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\AlbumTrack;

//Pattern Template de methode (usage fréquent) : Algo d'aff des tracks valide pr tte sorte de track

class AlbumTrackRenderer extends AudioTrackRenderer
{
    public function __construct(AlbumTrack $aT)
    {
        parent::__construct($aT);
    }

    protected function long(): string
    {
        return "<div class='track'>
                 <h1>{$this->track->titre}</h1>
                 <h2>{$this->track->album} - {$this->track->auteur}</h2>
                 <audio controls>
                    <source src='{$this->track->cheminfichier}' type='audio/mp3'>
                 </audio>
                 </div>";
    }
}