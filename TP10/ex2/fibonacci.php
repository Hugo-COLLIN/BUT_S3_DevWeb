<?php

session_start();

if (isset($_SESSION['fibonacci']))
{
    $l = sizeof($_SESSION['fibonacci']);
    $n1 = $_SESSION['fibonacci'][$l - 1];
    $n2 = $_SESSION['fibonacci'][$l - 2];
    print $n1 . "<br>" . $n2 . "<br>";
    $res = $n1 + $n2;
    $_SESSION['fibonacci'][] = $res;
    print_r($_SESSION['fibonacci']);
}
else
{
    $_SESSION['fibonacci'] = array(0,1);
    print_r($_SESSION['fibonacci']);
}
