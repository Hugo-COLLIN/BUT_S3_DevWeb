<?php

session_start();


    $_SESSION['fibonacci'] = array(0,1);
    print_r($_SESSION['fibonacci']);

//Correctionprof
$_SESSION['fibo'] = [
    (isset($_GET['u0']) ? intval($_GET['u0']) : 0)
    (isset($_GET['u1']) ? intval($_GET['u0']) : 1)
];