<?php 
    require_once ('db.php');
    require_once ('functions.php');
    if ( !empty($_SESSION['log_user']) )
    {
        redirect('u/meshcheryakov/back/2.4/index.php');
    }
    
    if ( isset($_SESSION['number_ban']) )
    {
         if ( $_SESSION['number_ban'] > 5)
         {
            redirect('login.php');
         }
    }  

    $data = $_POST;
    if( isset($data["go_regist"]) )
    {
        $errors = [];
        $no_errors = [];
        if( trim($data["login"]) == '' ) 
        {
            $errors [] = 'Введите логин!';
        }

        if (isset($data["login"]))
        {
            foreach ( $login_array as $key_user => $user_data) 
            {
                if ( $user_data["login"] === $data["login"] ) 
                {
                    $errors [] = 'Пользователь с таким именем уже существует!';
                }
            }
        }

        if( $data["password"] == '' ) 
        {
            $errors [] = 'Введите пароль!';
        }

        if( $data["password_2"] != $data["password"] ) 
        {
            $errors [] = 'Повторный пароль не совпадает с первым!';
        }

        if( empty($errors) )
        {
            $login_array_id = count($login_array) + 1;
            $login_array ['user'.$login_array_id]['login'] = $data['login'];
            $login_array ['user'.$login_array_id]['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $file = 'users.json';
            $file_w = fopen($file, "w");
            fwrite($file_w , json_encode($login_array, JSON_UNESCAPED_UNICODE));
            fclose($file_w );
            $no_errors [] = 'Регистрация прошла успешно!';
            refresh('u/meshcheryakov/back/2.4/auth/login.php');
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
    <title>Домашние задание 2.4</title>
</head>
<body>
<div class="form">

    <?php
    if (!empty($errors)) 
    {
        echo '<p style="color: red;">'.array_shift($errors).'</p>';
    } elseif (!empty($no_errors)) 
    {
        echo '<p style="color: green;">'.array_shift($no_errors).'</p>';
    }
    ?>
    <form action="signup.php" method="POST">
        <p>
            <lable id="login">Ваш логин:</lable><br />
            <input id="login" type="text" name="login" value="<?= @$data["login"] ?>" placeholder="admin">
        </p>
        <p>
            <lable id="password">Ваш пароль:</lable><br />
            <input id="password" type="password" name="password">
        </p>
        <p>
            <lable id="password_2">Повторите пароль:</lable><br />
            <input id="password_2" type="password" name="password_2">
        </p>
        <p>
            <input type="submit" name="go_regist" value="Зарегистрироватся">
        </p>
    </form>

</div>
</body>
</html>