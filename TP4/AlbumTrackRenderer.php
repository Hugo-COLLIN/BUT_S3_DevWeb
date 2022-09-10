<?php

class AlbumTrackRenderer
{
    private AlbumTrack $track;
    private string

    public function __construct()
    {

    }

    private function long(): string
    {
        $html = "<div class='track'>
                 <h1>{$this->track->titre}</h1>"
    }

    function render(int $selector):string
    {
    $html = "";
    switch ($selector)
    {
        case 1 :
            $html-$this->short();
        case 2 :

    }
}
}