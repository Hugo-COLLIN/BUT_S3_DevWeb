<?php
namespace iutnc\deefy\render;

use iutnc\deefy\exception\InvalidPropertyValueException;
use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class AudioListRenderer implements Renderer
{

    protected AudioList $list;
    protected AudioTrackRenderer $rend;

    public function __construct(AudioList $al)
    {
        $this->list = $al;
    }

    public function render(int $selector): string
    {
        $html = "<div class='trackList'>
                 <h1>{$this->list->nom}</h1>
                 <ul>";


        foreach ($this->list->tracklist as $item)
        {
            if ($item instanceof AlbumTrack) $rend = new AlbumTrackRenderer($item);
            elseif ($item instanceof PodcastTrack) $rend = new PodcastTrackRenderer($item);
            else throw new InvalidPropertyValueException();
            $html .= "<li>{$rend->render(1)}</li>";
        }

        /*Correction
        foreach ($this->list->tracklist as $track)
        {
            $trackrend = null;
            switch (get_class($track))
            {
                case 'AlbumTrack':
                    $trackrend = new AlbumTrackRenderer($track);
                    break;
                case 'PodcastTrack':
                    $trackrend = new PodcastTrackRenderer($track);
                    break;
            }

            $html .= $trackrend->render(Renderer::COMPACT);
        }
        */

        /*
        for ($i = 0 ; $i < sizeof($this->list) ; $i ++)
        {
            $html .= "<li>{$this->list}</li>";
        }
        */

        $html .= "</ul>
                 <p>{$this->list->nbPiste} pistes</p>
                 <p>Durée : {$this->list->dureeTot}</p>
                 </div>";

        return $html;
    }
}