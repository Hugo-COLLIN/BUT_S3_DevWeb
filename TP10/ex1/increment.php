<?php

session_start();

if (isset($_SESSION['sess_counter']))
{
    print ++ $_SESSION['sess_counter'];

}
else
{
    $_SESSION['sess_counter'] = 1;
    print "Créé";
}