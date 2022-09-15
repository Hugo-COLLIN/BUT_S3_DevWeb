<?php

abstract class AudioTrackRenderer implements Renderer
{
    protected AudioTrack $track;

    public function __construct (AudioTrack $aT)
    {
        $this->track = $aT;
    }

    protected function short(): string
    {
        return "<div class='track'>
                 <p>{$this->track->titre}</p>
                 <audio controls>
                    <source src='{$this->track->cheminfichier}' type='audio/mp3'>
                 </audio>
                 </div>";
    }

    protected abstract function long() : string;

    function render(int $selector) : string
    {
        $html = "";
        switch ($selector)
        {
            case Renderer::COMPACT :
                $html = $this->short();
                break;
            case Renderer::LONG :
                $html = $this->long();
                break;
        }
        return $html;
    }
}