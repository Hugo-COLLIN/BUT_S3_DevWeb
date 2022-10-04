<?php

if (isset($_COOKIE['countCookie'])) {
    setcookie("countCookie", ++ $_COOKIE['countCookie'], time() + 60, "/", "localhost");
    print $_COOKIE['countCookie'];
}
else
{
    setcookie("countCookie", 1, time() + 60, "/", "localhost");
    print "Creation cookie";
}
//print $_COOKIE['countCookie'];
