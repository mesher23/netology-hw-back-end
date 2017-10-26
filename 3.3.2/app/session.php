<?php
error_reporting(E_ALL);
session_start();
$_SESSION['cartNumber'] = isset($_SESSION['cartNumber']) ? $_SESSION['cartNumber'] : 0;
$_SESSION['cartPrice'] = isset($_SESSION['cartPrice']) ? $_SESSION['cartPrice'] : 0;