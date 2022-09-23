<?php

use iutnc\deefy\audio\exception\InvalidPropertyNameException;
use iutnc\deefy\audio\exception\InvalidPropertyValueException;
use iutnc\deefy\audio\exception\NotEditablePropertyException;
use iutnc\deefy\audio\lists\PlayList;
use iutnc\deefy\audio\render\AudioListRenderer;
use iutnc\deefy\audio\render\PodcastTrackRenderer;
use iutnc\deefy\audio\render\Renderer;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

require_once 'src/classes/render/Renderer.php';
require_once 'src/classes/audio/tracks/AudioTrack.php';
require_once 'src/classes/audio/tracks/AlbumTrack.php';
require_once 'src/classes/audio/tracks/PodcastTrack.php';
require_once 'src/classes/audio/lists/AudioList.php';
require_once 'src/classes/audio/lists/AlbumList.php';
require_once 'src/classes/audio/lists/PlayList.php';

require_once 'src/classes/render/AudioTrackRenderer.php';
require_once 'src/classes/render/AlbumTrackRenderer.php';
require_once 'src/classes/render/PodcastTrackRenderer.php';
require_once 'src/classes/render/AudioListRenderer.php';

require_once 'src/classes/exception/InvalidPropertyNameException.php';
require_once 'src/classes/exception/InvalidPropertyValueException.php';
require_once 'src/classes/exception/NotEditablePropertyException.php';


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
