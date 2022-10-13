<?php

require_once "vendor/autoload.php";
use \iutnc\deefy AS d;

/*
 * ---MAIN---
 */
if (!isset($_GET['action'])) $_GET['action'] = "";


switch ($_GET['action'])
{
    case 'add-user' :
        if ($_SERVER['REQUEST_METHOD'] == "GET")
            $rend = "
            <form method='post'>
                Email : <input type='email' name='mail'>
                Age : <input type='number' name='age'>
                Genre musical préféré : <input type='text' name='genre'>
                <input type='submit' value='Valider'>
            </form>";
        else
            $rend = "<p>Email: <strong>" . $_POST['mail'] .
                "</strong>, Age: <strong>" . $_POST['age'] .
                "</strong>, Genre musical: <strong>" . $_POST['genre'] . "</strong></p>";
        break;
    case 'add-playlist' :
        $rend = "2";
        break;
    case 'add-podcasttrack' :
        $rend = "3";
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
-->