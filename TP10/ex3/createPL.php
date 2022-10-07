<?php

require_once "vendor/autoload.php";

session_start();
$pl = new \iutnc\deefy\audio\lists\PlayList();
$_SESSION['list'] = serialize($pl)
