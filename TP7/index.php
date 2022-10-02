<?php

use iutnc\deefy\audio\tracks as t;
use iutnc\deefy\audio\lists as l;
use iutnc\deefy\render AS r;
use iutnc\deefy\exception AS e;


require_once "src/loader/ClassLoader.php";
$l = new \loader\ClassLoader("iutnc\\deefy\\", "src/classes");
$l->register();


//GENERATED
//require_once 'vendor/autoload.php';

/*
 --- MAIN ---
 */

$track1 = new t\AlbumTrack('I\'m with you', 'audio/01-Im_with_you_BB-King-Lucille.mp3');
$track2 = new t\AlbumTrack('I_Need_Your_Love', 'audio/02-I_Need_Your_Love-BB_King-Lucille.mp3');

try {
    $track1->album = 'Lucille';
    $track1->auteur = 'B.B. King';
    $track1->numPiste = 1;
    //$track1->propBidon = 56000;

    $track2->album = 'Lucille';
    $track2->auteur = 'B.B. King';
    $track2->numPiste = 2;
}
catch (e\InvalidPropertyNameException | e\InvalidPropertyValueException | e\NotEditablePropertyException $e)
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

$podcast = new t\PodcastTrack('Test', 'audio/03-Country_Girl-BB_King-Lucille.mp3');
$podcast->genre = 'Talk Show';
$podcast->auteur = 'Bli bla blo';
print $podcast;
//var_dump($podcast);

$pR = new r\PodcastTrackRenderer($podcast);
//print $pR->render(Renderer::COMPACT);
print $pR->render(r\Renderer::LONG);



$plist = new l\PlayList("Musique", array($track1));

$pLR = new r\AudioListRenderer($plist);
print $pLR->render(1);

$plist->addTrack($track2);

$plist2 = new l\PlayList("Musique");
$plist2->addTrackList(array($track1));

print $pLR->render(1);
