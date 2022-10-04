<?php

if (isset($_COOKIE['myCookie']))
    print $_COOKIE['myCookie'];
else
{
    setcookie("myCookie", "Bliblablo", time() + 60, "/", "localhost");
    print "Creation cookie";
}
