<?php

setcookie("myCookie", "Bliblablo", time() + 60, "../r2", "localhost");

if (isset($_COOKIE['myCookie']))
    print $_COOKIE['myCookie'];
else
    print "Creation cookie";