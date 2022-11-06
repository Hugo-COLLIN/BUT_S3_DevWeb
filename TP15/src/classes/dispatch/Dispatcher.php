<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action AS AC;

/**
 * Class that select action to execute depending on user activity on the website, and rend it
 */
class Dispatcher
{
    /**
     * @var string|mixed|null action performed by the user
     */
    protected ?string $action = null;

    /**
     * Constructor that set action attribute
     */
    public function __construct()
    {
        $this->action = $_GET['action'] ?? null;
    }

    /**
     * Method that select action to execute depending on user activity on the website
     * @return void
     */
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

    /**
     * Method that return string corresponding to the main content to show to user
     * @param string $html
     * @return void
     */
    private function renderPage(string $html) : void {
        echo $html;
    }
}