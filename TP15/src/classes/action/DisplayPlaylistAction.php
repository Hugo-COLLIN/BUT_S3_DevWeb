<?php

namespace iutnc\deefy\action;

use iutnc\deefy AS d;

class DisplayPlaylistAction extends Action
{

    public function execute(): string
    {
        $rend = "";
        if (!isset($_GET["id"]))
            $rend .= "Veuillez sélectionner une playlist";
        else
        {
            try {
                $pl = d\audio\lists\PlayList::find($_GET["id"]);
                d\auth\Auth::checkAccessLevel($_SESSION["user"], $_GET["id"]);
                $alr = new d\render\AudioListRenderer($pl);
                $rend .= $alr->render(d\render\Renderer::COMPACT);
            }
            catch (d\exception\EmptyRequestException $e)
            {
                $rend .= $e->getMessage();
            }

        }
        return $rend;
    }
}