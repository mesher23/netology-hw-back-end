<?php
session_start();
$_SESSION['cartNumber'] = isset($_SESSION['cartNumber']) ? $_SESSION['cartNumber'] : 0;