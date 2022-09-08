<?php
$playlist = [
    "nom" => "a",
    "genre" => "b",
    "créateur" => "c",
    "date" => "1-1-2000",
    "nbpistes" => 1,
    "durée" => 60,
    "pistes" => []
];

$piste1 = ["titre" => "Blue shell", "artiste" => "Blank", "album" => "Nero", "année" => "2154", "genre" => "Daft", "numéro" => 1, "durée" => 40];
$piste2 = ["titre" => "", "artiste" => "", "album" => "", "année" => "", "genre" => "", "numéro" => "", "durée" => ""];
$piste3 = ["titre" => "", "artiste" => "", "album" => "", "année" => "", "genre" => "", "numéro" => "", "durée" => ""];

//2:
function display (array $pl) : void
{
    /*
    $nom = $plist['nom'];
    $genre = $plist['genre'];
    $createur = $plist['créateur'];
    $date = $plist['date'];
    $nbpistes = $plist['nbpistes'];
    $duree = $plist['durée'];
    print "playlist : $nom ($genre)\npar $createur le $date\n $nbpistes pistes pour une durée totale de $duree"."s";
    */
    print "playlist : {$pl['nom']} ({$pl['genre']})\npar {$pl['créateur']} le {$pl['date']}\n{$pl['nbpistes']} piste(s) pour une durée de {$pl['durée']}s";
}

//display($playlist);

//print_r($playlist); // print récursif, pour le débogage

//4:
function display_track (array $tr, int $show = 0) : void
{
    switch ($show){
        case 1:
            print $tr['numéro'] . " " . $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'] . " " . $tr['durée'];
            break;
        case 2:
            print $tr['numéro'] . " " . $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'] . " " . $tr['durée'] . " " . $tr['année'];
            break;
        default:
            print $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'];
    }
    print "\n";
}
/*
display_track($piste1);
display_track($piste1, 1);
display_track($piste1, 2);
*/

//5:
function play_track (array $tr) : void
{
    print $tr['titre'] . "\n";
    for ($i = 1 ; $i <= $tr['durée'] ; $i ++)
        print $i . ".";
    print "\n";
}

//play_track($piste1);

//6:
function add_track (array $plist, array $tr) : array //trans par copie : pl est dupliqué
{
    // Faux :$plist['pistes'].array_push($tr);
    $plist['pistes'][] = $tr;
    //ou array_push($pl['pistes'], $tr);
    return $plist;
}

function add_track_ref (array &$plist, array $tr) : void
{
    array_push($plist['pistes'], $tr);
    return;
}
/*
print_r($playlist);
$playlist = add_track($playlist, $piste1);
print_r($playlist);
*/
/*
print_r($playlist);
add_track_ref($playlist, $piste1);
print_r($playlist);
*/

//+ dangereux par référence, il faut savoir ce qu'on fait
//le mieux dans ces cas est de prendre une copie du tableau et de retourner le tableau

//7:
function display_track_2 (array $tr, int $show = 0) : void
{
    switch ($show){
        case 1:
            print $tr['numéro'] . " " . $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'] . " " . $tr['durée'];
            break;
        case 2:
            print $tr['numéro'] . " " . $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'] . " " . $tr['durée'] . " " . $tr['année'];
            break;
        default:
            print $tr['titre'] . " " . $tr['artiste'] . " " . $tr['album'];
    }
    print "\n";

}