<?php

session_start();

if (isset($_SESSION['fibonacci']))
{
    $l = sizeof($_SESSION['fibonacci']);
    $n1 = $_SESSION['fibonacci'][$l - 1];
    $n2 = $_SESSION['fibonacci'][$l - 2];
    $res = $n1 + $n2;
    $_SESSION['fibonacci'][] = $res;
    print_r($_SESSION['fibonacci'][$l]);
}

