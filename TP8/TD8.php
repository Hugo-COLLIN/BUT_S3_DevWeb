<?php

/*
 * Si la désactivation de la temporisation de sortie ne fonctionne pas avec le .htaccess 
 * fourni, il est possible de forcer l'envoi les données du tampon de sortie et d'éteindre 
 * la temporisation de sortie avec la fonction ob_end_flush() au début du script.
 */

//ob_end_flush();
/*
$_SERVER['QUERY_STRING'] = 'testo';
echo '<pre>'; 
var_dump($_SERVER);
*/
/*
http_response_code("201");
header("bla: blo");
*/
//ob_start();

echo "<p>" . $_SERVER["REQUEST_METHOD"] . " " . $_SERVER["REQUEST_URI"] . " " . $_SERVER["SERVER_PROTOCOL"] . " " . http_response_code() . "</p>";

$h = getallheaders();
foreach ($h as $item => $value)
    echo "<b>" . $item . " : </b>" . $value . "<br>";

 //activer ob_start() pour que ça marche
/*
http_response_code("201");
header("bla: blo");
*/

echo http_response_code();