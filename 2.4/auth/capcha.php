<?php
    $session_num_ban = ( isset($_SESSION['number_ban']) ? $_SESSION['number_ban'] : 0);
    $session_num = ( isset($_SESSION['number']) ? $_SESSION['number'] : 0);
    $session_num++;
    $_SESSION['number'] = $session_num;

    $capcha_keys = [
        'public_key' => '6LfsMRsUAAAAAAy3cHNpSfliKF31Sui745DBLuLY',
        'secret_key' => '6LfsMRsUAAAAAHgStjPik3ZRys8yiN-tcr2E_ih-'
    ];
    if ( isset($_POST["g-recaptcha-response"]) )
    {
        $capcha_query = 'https://www.google.com/recaptcha/api/siteverify?secret='.$capcha_keys['secret_key'].'&response='.$_POST["g-recaptcha-response"].'&remoteip='.$_SERVER['REMOTE_ADDR'];
        $send_capcha = file_get_contents($capcha_query);
        $reply_capcha = json_decode($send_capcha, true);
    }

    if ( isset($_POST["g-recaptcha-response"]) )
    {
        $session_num_ban++;
        $_SESSION['number_ban'] = $session_num_ban;
        $capcha_errors = [];
        if ( $_POST["g-recaptcha-response"] == '' )
        {
            $capcha_errors [] = 'Заполните капчу!';
        } elseif ( $reply_capcha["success"] )
        {
            $capcha_true = true;
        } else {
            $capcha_errors [] = 'Капча заполнена не верно';
        }
    }