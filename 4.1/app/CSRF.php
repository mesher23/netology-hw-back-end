<?php
require_once 'session.php';
$_SESSION['csrfTokenPost'] = isset($_SESSION['csrfTokenPost']) ? $_SESSION['csrfTokenPost'] : '';
$_SESSION['csrfToken'] = isset($_SESSION['csrfToken']) ? $_SESSION['csrfToken'] : '';
$_POST['csrf'] = isset($_POST['csrf']) ? $_POST['csrf'] : '';
$csrfToken = '';
if (empty($_POST['csrf']) || isset($_POST['inquiry'])) {
    $_SESSION['csrfTokenPost'] = $_SESSION['csrfToken'];
    if (version_compare(PHP_VERSION, '7.0.0', '>=')) {
        $csrfToken = bin2hex(random_bytes(32));
    } else {
        if (function_exists('mcrypt_create_iv')) {
            $csrfToken = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_RANDOM));
        } else {
            $csrfToken = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
    $_SESSION['csrfToken'] = $csrfToken;
}

if(!function_exists('hash_equals')) {
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}