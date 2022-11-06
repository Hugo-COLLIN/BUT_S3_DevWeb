<?php

session_start();
/*
 * filter_var avec un FILTER_VALIDATE renvoie soit la chaine entière si ok, soit chaine vide si contient des caractères spéciaux
 * alors que filter_var avec FILTER_SANITIZE renvoie la chaine dépourvue des caractères spéciaux
 */
require_once "vendor/autoload.php";
use iutnc\deefy AS d;
use \iutnc\deefy\db\ConnectionFactory;

ConnectionFactory::setConfig('./config.ini');
$dispatcher = new d\dispatch\Dispatcher();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP15 - Hugo COLLIN's Deefy App</title>
</head>
<body>
    <header>
        <h1>Hugo COLLIN - S3A</h1>
        <h4>06/11/2022 - IUT Nancy-Charlemagne</h4>
    </header>
    <nav>
        <ul>
            <li><a href="./">Accueil</a></li>
            <li><a href="./?action=signin">Connexion</a></li>
            <li><a href="./?action=add-user">Inscription</a></li>
            <li><a href="./?action=display-playlist">Afficher une playlist</a></li>
            <li><a href="./?action=add-playlist">Ajouter une playlist</a></li>
            <li><a href="./?action=add-podcasttrack">Ajouter un podcast</a></li>
        </ul>
    </nav>

    <main>
        <?php $dispatcher->run(); ?>
    </main>
</body>
</html>