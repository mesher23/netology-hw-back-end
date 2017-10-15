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
    if( isset($data["go_visitor"]) )
    {
        $_SESSION['visitor'] = $data;
        redirect('u/meshcheryakov/back/2.4/index.php');
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

    <form action="visitor.php" method="POST">
        <p>
            <lable id="login">Введите ваше имя:</lable><br />
            <input id="login" type="text" name="login" placeholder="Никита">
        </p>
        <p>
            <input type="submit" name="go_visitor" value="Войти">
        </p>
    </form>

</div>
</body>
</html>