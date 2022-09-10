<?php

require_once 'AlbumTrack.php';

$track1 = new AlbumTrack('I\'m with you', 'audio/01-Im_with_you_BB-King-Lucille.mp3');
$track2 = new AlbumTrack('I_Need_Your_Love', 'audio/02-I_Need_Your_Love-BB_King-Lucille.mp3');
//$track3 = new AlbumTrack('Country_Girl', 'audio/03-Country_Girl-BB_King-Lucille.mp3');

$track1->album = 'Lucille';
$track1->artiste = 'B.B. King';
$track1->numPiste = 1;

$track2->album = 'Lucille';
$track2->artiste = 'B.B. King';
$track2->numPiste = 2;

//Affichage
print $track1->__toString() . "\n";
print $track2 . "\n";

var_dump($track1);

//print "$track1\n";


