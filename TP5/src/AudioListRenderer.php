<?php

class AudioListRenderer implements Renderer
{

    protected AudioList $list;

    public function __construct(AudioList $al)
    {
        $this->list = $al;
    }

    public function render(int $selector): string
    {
        $html = "<div class='trackList'>
                 <h1>{$this->list->nom}</h1>
                 <p>{$this->list}</p>
                 <p>{$this->list->nbPiste}</p>
                 <p>{$this->list->dureeTot}</p>
                 </div>";

        return $html;
    }
}