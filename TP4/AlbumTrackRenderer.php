<?php

class AlbumTrackRenderer
{
    private AlbumTrack $track;
   // private string

    public function __construct(AlbumTrack $aT)
    {
        $this->track = $aT;
    }

    private function short(): string
    {
        return "<div class='track'>
                 <p>{$this->track->titre}</p>
                 <audio controls>
                    <source src='{$this->track->cheminfichier}' type='audio/mp3'>
                 </audio>
                 </div>";
    }

    private function long(): string
    {
        return "<div class='track'>
                 <h1>{$this->track->titre}</h1>
                 <h2>{$this->track->album} - {$this->track->artiste}</h2>
                 <audio controls>
                    <source src='{$this->track->cheminfichier}' type='audio/mp3'>
                 </audio>
                 </div>";
    }

    function render(int $selector):string
    {
        $html = "";
        switch ($selector)
        {
            case 1 :
                $html = $this->short();
                break;
            case 2 :
                $html = $this->long();
                break;
            default:
                $html = $this->short();
                break;
        }
        return $html;
    }
}