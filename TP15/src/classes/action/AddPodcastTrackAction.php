<?php

namespace iutnc\deefy\action;

use iutnc\deefy AS d;

class AddPodcastTrackAction extends Action
{

    public function execute(): string
    {
        $rend = "";
        if (!isset($_SESSION["playlist"]))
            $rend .= "Créez d'abord une playlist";
        else if ($_SERVER['REQUEST_METHOD'] == "GET")
            $rend .= <<<END
                <form method='post' action='?action=add-podcasttrack' enctype="multipart/form-data">
                    Uploader un fichier : <input type="file" name="upload"><br>
                    Nom du podcast : <input type='text' name='podname'><br>
                    <input type='submit' value='Valider'>
                </form>
            END;
        else
        {
            $backLink =  "<br><a href='?action=add-podcasttrack'>&larr; Retour</a>";
            if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0) {
                $allowed = array("mp3" => "audio/mp3", "mpeg" => "audio/mpeg");
                $pFilename = filter_var($_FILES["upload"]["name"], FILTER_SANITIZE_SPECIAL_CHARS);
                $pType = $_FILES["upload"]["type"];
                $pSize = $_FILES["upload"]["size"];
                $pNom = $_POST["podname"];

                // Vérifie l'extension du fichier
                $ext = pathinfo($pFilename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) {
                    $rend .= "Veuillez sélectionner un format de fichier valide. $backLink";
                    return $rend;
                }

                // Vérifie la taille du fichier
                $maxsize = 20 * 1024 * 1024;
                if ($pSize > $maxsize) {
                    $rend .= "La taille du fichier est supérieure à la limite autorisée. $backLink";
                    return $rend;
                }

                $dir = "";
                $pT = new d\audio\tracks\PodcastTrack($pNom, $dir);
                if (in_array($pType, $allowed)) {
                    // Vérifie si le fichier existe avant de le télécharger.
                    if (file_exists("./audio/" . $_FILES["upload"]["name"]))
                        $rend .= "$pFilename existe déjà. $backLink";
                    else {
                        $dir = "./audio/" . $_FILES["upload"]["name"];
                        move_uploaded_file($_FILES["upload"]["tmp_name"], $dir);
                        $rend .= "Votre fichier $pFilename a été téléchargé avec succès. $backLink";

                        $pl = unserialize($_SESSION["playlist"]);
                        $pl->addTrack($pT);
                        $_SESSION["playlist"] = serialize($pl);
                    }

                    $ptr =  new d\render\PodcastTrackRenderer($pT);
                    $rend .= $ptr->render(d\render\Renderer::COMPACT);
                }
                else
                    $rend .= "Problème de téléchargement du fichier, veuillez réessayer. $backLink";
            }
            else if (isset($_POST["podname"]))
                $rend .= "Veuillez uploader un fichier $backLink";
            else
                $rend .= "Veuillez rentrer toutes les informations nécessaires. $backLink";
        }
        return $rend;
    }
}