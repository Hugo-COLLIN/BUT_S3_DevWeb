<?php

require_once 'vendor/autoload.php';

//use x6

use \iutnc\deefy\db\ConnectionFactory;

ConnectionFactory::setConfig('./config.ini');
ConnectionFactory::makeConnection();



