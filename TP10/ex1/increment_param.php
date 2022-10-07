<?php

session_start();

function addNb () : int
{
    $nb = 1;
    if (isset($_GET['param']))
        $nb = $_GET['param'];
    return $nb;
}


if (isset($_SESSION['sess_counter2']))
{
    print $_SESSION['sess_counter2'] += addNb();
}
else
{
    $_SESSION['sess_counter2'] = addNb();
    print "Créé";
}