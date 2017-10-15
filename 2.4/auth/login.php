<?php
    require_once ('db.php');
    require_once ('functions.php');
    require_once ('capcha.php');

    if ( !empty($_SESSION['log_user']) )
    {
        redirect('u/meshcheryakov/back/2.4/index.php');
    }
    $data = $_POST;
    if( isset($data["go_login"]) )
    {
        $errors = [];
        $no_errors = [];
        if ( isset($data["login"]) )
        {
            foreach ( $login_array as $user )
            {
                if ( array_search($data["login"], $user) === 'login' )
                {
                    $no_errors [] = 1;
                    if ( !password_verify($data["password"], $user["password"]) )
                    {
                        $errors [] = 'Неправельно введён пароль!';
                    }
                }
            }
        }
        if ( $session_num_ban === 0 )
        {
            if ( empty($errors) and !empty($no_errors) )
            {
                $_SESSION['log_user'] = $data;
                redirect('u/meshcheryakov/back/2.4/index.php');
                die;
            } elseif ( empty($no_errors) )
            {
                $errors [] = 'Пользователя с таким логин не существует!';
            }
        } else
        {
            if ( empty($capcha_errors) )
            {
                if ( empty($errors) and !empty($no_errors) )
                {
                    if ( $capcha_true )
                    {
                        $_SESSION['log_user'] = $data;
                        redirect('u/meshcheryakov/back/2.4/index.php');
                        die;
                    }
                }else
                {
                    $errors [] = 'Пользователя с таким логин не существует!';
                } 
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="/u/meshcheryakov/back/2.4/css/style.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Домашние задание 2.4</title>
</head>
<body>
<div class="form">

    <?php 
        if ( isset($_SESSION['number_ban']) ):
            if ( $_SESSION['number_ban'] > 5): ?>
        <p style="color: red;">У меня не хватила сил сделать, что бы бан был на определённое время.<br /> Вы заблокированы на час!<br /> Нажмите на конопку через час</p>
        <form action="logout.php" method="POST">
            <input type="submit" value="Снять бан">
        </p>
        </form>
    <?php   
                die;
            endif;
        endif;
        if ( !empty($errors) ) 
        {
            echo '<p style="color: red;">'.array_shift($errors).'</p>';
        }
    ?> 

    <?php if( $_SESSION['number'] < 6 ): ?>   
    <form action="login.php" method="POST">
        <p>
            <lable id="login">Логин:</lable><br />
            <input id="login" type="text" name="login" value="<?= @$data["login"] ?>" placeholder="admin">
        </p>
        <p>
            <lable id="password">Пароль:</lable><br />
            <input id="password" type="password" name="password">
        </p>
        <p>
            <input type="submit" name="go_login" value="Войти">
        </p>
    </form>
    <?php endif; ?>

    <?php if( $_SESSION['number'] >= 6 ):
        switch ( $session_num_ban ) 
        {
            case 1:
                echo '<p>У Вас осталось '.(6-$session_num_ban).' попыток</p>';
                break;
            case 2:
                echo '<p>У Вас осталось '.(6-$session_num_ban).' попытки</p>';
                break;
            case 3:
                echo '<p style="color: red;">У Вас осталось '.(6-$session_num_ban).' попытки</p>';
                break;
            case 4:
                echo '<p style="color: red;">У Вас осталось '.(6-$session_num_ban).' попытки</p>';
                break;
            case 5:
                echo '<p style="color: red;">У Вас осталось '.(6-$session_num_ban).' попытка</p>';
                break;
        }
    ?>    

    <form action="login.php" method="POST">
        <p>
            <lable id="login">Логин:</lable><br />
            <input id="login" type="text" name="login" value="<?= @$data["login"] ?>" placeholder="admin">
        </p>
        <p>
            <lable id="password">Пароль:</lable><br />
            <input id="password" type="password" name="password">
        </p>
        <p>
            <input type="submit" name="go_login" value="Войти">
        </p>
        <div class="g-recaptcha" data-sitekey="6LfsMRsUAAAAAAy3cHNpSfliKF31Sui745DBLuLY"></div>
    </form>
    <?php endif; ?>

</div>
</body>
</html>