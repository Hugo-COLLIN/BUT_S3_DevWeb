<?php

class PodcastTrackRenderer extends AudioTrackRenderer
{
    public function __construct(PodcastTrack $aT)
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