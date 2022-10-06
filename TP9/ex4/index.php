<?php

require_once "vendor/autoload.php";
use \iutnc\deefy AS d;

if (!isset($_COOKIE['track']))
{
    $at = new d\audio\tracks\AlbumTrack("I'm with you", "audio/01-Im_with_you_BB-King-Lucille.mp3");
    $atS = serialize($at);
    setcookie('track', $atS, time()+60, "/", "localhost");
    print "Setting cookie";
}
else
{
    print $c = $_COOKIE['track'];
    $atU = unserialize($c);
    $atRend = new d\render\AlbumTrackRenderer($atU);
    print $atRend->render(d\render\Renderer::COMPACT);
}





























/*
if (isset($_COOKIE))
        $t = cookie track
        $track = unserialize($t);
$r1 = \iutnc\deefy\...\RedererFactory
else
        crée track


setcookie (c, serialize($track1))
*/