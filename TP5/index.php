<?php

use exceptions\InvalidPropertyNameException;
use exceptions\InvalidPropertyValueException;
use exceptions\NotEditablePropertyException;
//use track\AlbumTrack;
//use track\PodcastTrack;

require_once 'src/Renderer.php';
require_once 'src/AudioTrack.php';
require_once 'src/AlbumTrack.php';
require_once 'src/PodcastTrack.php';
require_once 'src/AudioList.php';
require_once 'src/AlbumList.php';
require_once 'src/PlayList.php';

require_once 'src/AudioTrackRenderer.php';
require_once 'src/AlbumTrackRenderer.php';
require_once 'src/PodcastTrackRenderer.php';
require_once 'src/AudioListRenderer.php';

require_once 'src/exceptions/InvalidPropertyNameException.php';
require_once 'src/exceptions/InvalidPropertyValueException.php';
require_once 'src/exceptions/NotEditablePropertyException.php';


$track1 = new AlbumTrack('I\'m with you', 'audio/01-Im_with_you_BB-King-Lucille.mp3');
$track2 = new AlbumTrack('I_Need_Your_Love', 'audio/02-I_Need_Your_Love-BB_King-Lucille.mp3');

try {
    $track1->album = 'Lucille';
    $track1->auteur = 'B.B. King';
    $track1->numPiste = 1;
    //$track1->propBidon = 56000;

    $track2->album = 'Lucille';
    $track2->auteur = 'B.B. King';
    $track2->numPiste = 2;
}
catch (InvalidPropertyNameException | InvalidPropertyValueException | NotEditablePropertyException $e)
{
    print $e->getMessage() ."<br>";
    print $e->getTraceAsString();
}


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



$plist = new PlayList("Musique", array($track1));

$pLR = new AudioListRenderer($plist);
print $pLR->render(1);

$plist->addTrack($track2);

$plist2 = new PlayList("Musique");
$plist2->addTrackList(array($track1));

print $pLR->render(1);


//$album = new AlbumList();
