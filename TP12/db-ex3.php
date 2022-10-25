<?php

require_once 'vendor/autoload.php';

//use x6

use \iutnc\deefy\db\ConnectionFactory;

ConnectionFactory::setConfig('./config.ini');

$user = new iutnc\deefy\user\User("user1@email.com", "1234", "admin");

$usrPl = $user->getPlaylist();

foreach( $usrPl as $pl)
    echo $pl->nom $pl->id

print_r(
    $user->getPlaylist()
);

//$u->testQuery();


//Q2
