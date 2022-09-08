<?php
$playlist = ["nom" => "a", "genre" => "b", "créateur" => "c", "date" => "1-1-2000", "nbpistes" => 1, "durée" => 60];

function display (array $pl) : void
{
    print "playlist : {$pl['nom']} ({$pl['genre']})\npar {$pl['créateur']} le {$pl['date']}\n{$pl['nbpistes']} piste(s) pour une durée de {$pl['durée']}s";
}

display($playlist);