<?php

session_start();
/*
 * filter_var avec un FILTER_VALIDATE renvoie soit la chaine entière si ok, soit chaine vide si contient des caractères spéciaux
 * alors que filter_var avec FILTER_SANITIZE renvoie la chaine dépourvue des caractères spéciaux
 */
require_once "vendor/autoload.php";
use \iutnc\deefy AS d;

/*
 * ---MAIN---
 */
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
            catch (d\audio\exception\InvalidPropertyValueException $e)
            {
                $rend .= "Erreur";
            }

            $rend .= "<a href=\"?action=add-podcasttrack\">Ajouter une piste &rarr;</a>";
        }
        break;
    case 'add-podcasttrack' :
        if ($_SERVER['REQUEST_METHOD'] == "GET")
            $rend .= <<<END
                <form method='post' action='?action=add-podcasttrack' enctype="audio">
                    Uploader un fichier : <input type="file" name="upload"><br>
                    Nom du podcast : <input type='text' name='podnom'><br>
                    <input type='submit' value='Valider'>
                </form>
            END;
        else
        {
            if (is_uploaded_file($_FILES['upload']['tmp_name']) && $_FILES['upload']['type'] === "audio/mp4")
            {

            }
        }

        break;
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
        <li><a href="./?action=add-user">Ajouter un utilisateur</a></li>
        <li><a href="./?action=add-playlist">Ajouter une playlist</a></li>
        <li><a href="./?action=add-podcasttrack">Ajouter un podcast</a></li>
    </ul>
    <?php echo $rend; ?>
</body>
</html>



<!--

        else if ($_POST['mail'] != null OR $_POST['age'] != null OR $_POST['genre'] != null)
            $rend = $form . "<small>Tous les champs sont obligatoires</small>";

        ---

        $nom = filter_var($_POST['podnom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $pod = new d\audio\tracks\PodcastTrack($nom);
            $sessnom = "pod_$nom";
            //$_SESSION[$sessnom] = serialize($pod);
            $ptr = new d\render\PodcastTrackRenderer($pod);

            if (($file = $_FILES['upload']['name']) != "")
            {
                $dir = "audio/";
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['my_file']['tmp_name'];
                $path_filename_ext = $dir . $filename . "." . $ext;
            }

            try {
                $rend .= $ptr->render(d\render\Renderer::COMPACT);
            }
            catch (d\audio\exception\InvalidPropertyValueException $e)
            {
                $rend .= "Erreur";
            }
-->