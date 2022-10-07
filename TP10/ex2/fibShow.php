<?php

session_start();

if (isset($_SESSION['fibonacci'])) {
    foreach ($_SESSION['fibonacci'] as $item => $value) {
        print $item . " => " . $value . "<br>";
    }
}