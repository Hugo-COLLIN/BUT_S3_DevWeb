<?php

session_start();
/*
 * filter_var avec un FILTER_VALIDATE renvoie soit la chaine entière si ok, soit chaine vide si contient des caractères spéciaux
 * alors que filter_var avec FILTER_SANITIZE renvoie la chaine dépourvue des caractères spéciaux
 */
require_once "vendor/autoload.php";
use iutnc\deefy AS d;
use \iutnc\deefy\db\ConnectionFactory;


/*
 * ---MAIN---
 */

ConnectionFactory::setConfig('./config.ini');
ConnectionFactory::makeConnection();

if (!isset($_GET['action'])) $_GET['action'] = "";
//$action = isset($_GET['action']) ? $_GET['action'] : null;
//$action = $_GET['action'] ?? null;

$rend = "";

switch ($_GET['action'])
{
    case 'add-user' :
        if ($_SERVER['REQUEST_METHOD'] == "GET")
            $rend .= "
            <form method='post' action='?action=add-user'>
                Email : <input type='email' name='mail'>
                Age : <input type='number' name='age'>
                Genre musical préféré : <input type='text' name='genre'>
                <input type='submit' value='Valider'>
            </form>";
        else
        {
            $_POST['mail'] = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $_POST['age'] = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
            $_POST['genre'] = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);

            $rend .= "<p>Email: <strong>" . $_POST['mail'] .
                "</strong>, Age: <strong>" . $_POST['age'] .
                "</strong>, Genre musical: <strong>" . $_POST['genre'] . "</strong></p>";
        }
        break;
    case 'add-playlist' :
        if ($_SERVER['REQUEST_METHOD'] == "GET")
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
        break;
    case 'add-podcasttrack' :
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
            //if (is_uploaded_file($_FILES['upload']['tmp_name']) && $_FILES['upload']['type'] === "audio/mp4")
            if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0) {
                $allowed = array("mp3" => "audio/mp3", "mpeg" => "audio/mpeg");
                $pFilename = filter_var($_FILES["upload"]["name"], FILTER_SANITIZE_SPECIAL_CHARS);
                $pType = $_FILES["upload"]["type"];
                $pSize = $_FILES["upload"]["size"];
                $pNom = $_POST["podname"];

                // Vérifie l'extension du fichier
                $ext = pathinfo($pFilename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) {
                    $rend .= "Erreur : Veuillez sélectionner un format de fichier valide. $backLink";
                    break;
                }

                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 20 * 1024 * 1024;
                if ($pSize > $maxsize) {
                    $rend .= "Erreur: La taille du fichier est supérieure à la limite autorisée. $backLink";
                    break;
                }

                $dir = "";
                $pT = new d\audio\tracks\PodcastTrack($pNom, $dir);
                // Vérifie le type MIME du fichier
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
                    $rend .= "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer. $backLink";
            }
            else if (isset($_POST["podname"]))
                $rend .= "Veuillez uploader un fichier $backLink";
            else
                $rend .= "Veuillez rentrer toutes les informations nécessaires. $backLink";
        }

        break;
    case 'signin':
        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            $rend .= <<<END
                <h3>Connexion</h3>
                <form method='post' action='?action=signin' enctype="multipart/form-data">
                    Email : <input type="email" name="email">
                    Password : <input type='text' name='password'>
                    <input type='submit' value='Valider'>
                </form>
            END;
        }
        else
        {
            $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $pwd = $_POST['password'];
            $user = d\auth\Auth::authentificate($mail, $pwd);
            d\auth\Auth::loadProfile($_POST['email']);
            $authuser = unserialize($_SESSION['user']);
            $rend .= "<p>Successfully connected !</p><ul>";

            foreach ($user->getPlaylist() as $item)
            {
                $alr = new d\render\AudioListRenderer($item);
                $rend .= "<li>" . $alr->render(d\render\Renderer::COMPACT) . "</li>";
            }
            $rend .= "</ul>";


        }
        //ds try catch
        break;

    case 'adduser':
        d\auth\Auth::reister($_POST['email'], $_POST['password']);
        $rend .= "<h4>Compte créé avec succès - vous pouvez vous connecter</h4>"
            //Ds try catch
    default:
        $rend = "Bienvenue !";
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP11 - Deefy Forms</title>
</head>
<body>
    <ul>
        <li><a href="./">Accueil</a></li>
        <li><a href="./?action=signin">Connexion</a></li>
        <li><a href="./?action=signup">Inscription</a></li>
        <li><a href="./?action=add-user">Ajouter un utilisateur</a></li>
        <li><a href="./?action=add-playlist">Ajouter une playlist</a></li>
        <li><a href="./?action=add-podcasttrack">Ajouter un podcast</a></li>
    </ul>
    <?php echo $rend; ?>
</body>
</html>