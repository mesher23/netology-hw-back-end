<?php
    require_once ('./auth/functions.php');
    if ( !empty($_SESSION['log_user']) || !empty($_SESSION['visitor']) )
    {
        redirect('u/meshcheryakov/back/2.4/admin.php');
    }

    if ( isset($_SESSION['number_ban']) )
    {
         if ( $_SESSION['number_ban'] > 5)
         {
            redirect('./auth/login.php');
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

    <?php if ( !empty($_SESSION['log_user']) ): ?>
    <h1>Добро пожаловать <?= $_SESSION['log_user']['login'] ?></h1>
    <?php endif ?>

    <?php if ( !empty($_SESSION['visitor']) ): ?>
    <h1>Добро пожаловать <?= $_SESSION['visitor']['login'] ?></h1>
    <?php endif ?>

    <?php if ( empty($_SESSION['log_user']) && empty($_SESSION['visitor']) ): ?>
    <a href="auth/login.php">Авторизоваться</a><br />
    <a href="auth/signup.php">Регистрация</a><br />
    <a href="auth/visitor.php">Войти как гость</a>
    <?php endif ?>

    <?php if ( !empty($_SESSION['log_user']) ): ?>
    <a href="auth/logout.php">Выйти</a><br />
    <?php endif ?>

    <?php if ( !empty($_SESSION['visitor']) ): ?>
    <a href="auth/login.php">Авторизоваться</a><br />
    <a href="auth/signup.php">Регистрация</a><br />
    <a href="auth/logout.php">Выйти</a><br />
    <?php endif ?>

</div>
</body>
</html>