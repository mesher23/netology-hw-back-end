<?php
require_once 'app/session.php';
session_destroy();
header('Location:index.php');
