<?php

namespace iutnc\deefy\action;

use iutnc\deefy AS d;
use iutnc\deefy\exception\AlreadyStoredException;
use iutnc\deefy\exception\AuthException;
use iutnc\deefy\exception\EmptyRequestException;
use iutnc\deefy\exception\InvalidPropertyNameException;

/**
 * Class that create the add-playlist view
 * @author Hugo COLLIN
 */
class AddPlaylistAction extends Action
{

    /**
     * Method that create the view
     * @return string main view
     */
    public function execute(): string
    {
        $rend = "<h3>Créer une playlist</h3>";
        if (!isset($_SESSION["user"]))
            $rend .= "Veuillez vous connecter";
        else if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            $rend .= <<<END
                <form method='post' action='?action=add-playlist'>
                  Nom de la playlist : <input type='text' name='plnom'>
                    <input type='submit' value='Valider'>
                </form>
            END;
        }
        else
        {
            $nom = filter_var($_POST['plnom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $pl = new d\audio\lists\PlayList($nom);
            //$sessnom = "pl_$nom";
            $_SESSION["playlist"] = serialize($pl);

            try {
                $user = unserialize($_SESSION["user"]);
                $user->addPlaylist($pl);
            }
            catch (AuthException | InvalidPropertyNameException | AlreadyStoredException | EmptyRequestException $e)
            {
                $rend .= $e->getMessage();
            }

            $alr = new d\render\AudioListRenderer($pl);

            try {
                $rend .= $alr->render(d\render\Renderer::COMPACT);
            }
            catch (d\exception\InvalidPropertyValueException $e)
            {
                $rend .= "Erreur";
            }

            $rend .= "<a href=\"?action=add-podcasttrack\">Ajouter une piste &rarr;</a>";
        }
        return $rend;
    }
}