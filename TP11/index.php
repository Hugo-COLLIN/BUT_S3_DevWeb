<?php

require_once "vendor/autoload.php";
use \iutnc\deefy AS d;

$rend = "<!doctype html><html><body>";

if (!isset($_GET['action'])) $_GET['action'] = "";

switch ($_GET['action'])
{
    case 'add-user' :
        $rend .= "";
        break;
    case 'add-playlist' :
        break;
    case 'add-podcasttrack' :
        break;
    default:
        $rend = "Bienvenue !";
}

$rend .= "</body></html>";



