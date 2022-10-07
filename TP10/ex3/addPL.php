<?php

require_once "vendor/autoload.php";
//Amodif
session_start();
$_SESSION["list"]->addTrack(new \iutnc\deefy\audio\tracks\PodcastTrack("TitrePodcast", "audio/01-Im_with_you_BB-King-Lucille.mp3"));
