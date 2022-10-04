<?php

if (isset($_COOKIE['countCookie'])) {
    print $_COOKIE['countCookie'];
    setcookie("countCookie", $_COOKIE['countCookie'] + 1, time() + 60, "/", "localhost");
}
else
{
    setcookie("countCookie", 1, time() + 60, "/", "localhost");
    print "Creation cookie";
}
//print $_COOKIE['countCookie'];
