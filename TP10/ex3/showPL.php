<?php

require_once "vendor/autoload.php";

session_start();
$pl = unserialize($_SESSION['list']);
$r = new \iutnc\deefy\render\PodcastTrackRenderer($pl);

$r->render();