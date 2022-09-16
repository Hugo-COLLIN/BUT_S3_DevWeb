<?php

require_once 'src/track/Renderer.php';
require_once 'src/track/AudioTrack.php';
require_once 'src/track/AlbumTrack.php';
require_once 'src/track/PodcastTrack.php';

require_once 'src/track/AudioTrackRenderer.php';
require_once 'src/track/AlbumTrackRenderer.php';
require_once 'src/track/PodcastTrackRenderer.php';


$track1 = new AlbumTrack('I\'m with you', 'audio/01-Im_with_you_BB-King-Lucille.mp3');
$track2 = new AlbumTrack('I_Need_Your_Love', 'audio/02-I_Need_Your_Love-BB_King-Lucille.mp3');


$track1->album = 'Lucille';
$track1->auteur = 'B.B. King';
$track1->numPiste = 1;

$track2->album = 'Lucille';
$track2->auteur = 'B.B. King';
$track2->numPiste = 2;

//Affichage
//print $track1->__toString() . "\n";
//print $track2 . "\n";

//var_dump($track1);

//print "$track1\n";


/*$r = new AlbumTrackRenderer($track1);

print $r->render(1);
print $r->render(2);
*/

$podcast = new PodcastTrack('Test', 'audio/03-Country_Girl-BB_King-Lucille.mp3');
$podcast->genre = 'Talk Show';
$podcast->auteur = 'Bli bla blo';
print $podcast;
//var_dump($podcast);

$pR = new PodcastTrackRenderer($podcast);
//print $pR->render(Renderer::COMPACT);
print $pR->render(Renderer::LONG);
