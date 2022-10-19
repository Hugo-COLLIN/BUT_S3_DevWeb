<?php

require_once 'vendor/autoload.php';

//use x6

use \iutnc\deefy\db\ConnectionFactory;

ConnectionFactory::setConfig('./config.ini');
ConnectionFactory::makeConnection();


$u = new iutnc\deefy\user\User("a@b.com", "1234", "admin");

//print_r($u->getPlaylist());

$u->testQuery();