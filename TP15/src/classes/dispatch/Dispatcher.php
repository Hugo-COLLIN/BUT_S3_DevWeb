<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action AS AC;

class Dispatcher
{
    protected ?string $action = null;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? null;
    }

    public function run() : void
    {
        $act = null;
        switch ($this->action) {
            case 'add-user':
                $act = new AC\AddUserAction();
                break;
            case 'signin' :
                $act = new AC\SigninAction();
                break;
            case 'add-playlist' :
                $act = new AC\AddPlaylistAction();
                break;
            case 'add-podcasttrack' :
                $act = new AC\AddPodcastTrackAction();
                break;
            case 'display-playlist' :
                $act = new AC\DisplayPlaylistAction();
                break;
        }
        if (!is_null($act)) $html = $act->execute();
        else $html = "Bienvenue !";

        $this->renderPage($html);
    }

    private function renderPage(string $html) : void {
        echo $html;
    }
}