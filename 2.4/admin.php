<?php
    require_once './auth/functions.php';
    if ( empty($_SESSION['log_user']) && empty($_SESSION['visitor']) )
    {
        redirect('u/meshcheryakov/back/2.4/index.php');
    }

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    if( isset($_FILES['file']['tmp_name']) === true ) 
    {
        $errors = [];
        $no_errors = [];
        $user_fail = file_get_contents($_FILES['file']['tmp_name']);
        $array_json_user = json_decode($user_fail, true);
                    
        if( file_exists("./json/".md5($array_json_user["name"]).".json") ) 
        {
            $errors [] = 'Тест с таким именем уже есть! Придумаёте другое имя.';
        } else 
        {
            $file = "./json/".md5($array_json_user["name"]).".json";
            if( !file_exists($file) ) 
            {
                $fp = fopen($file, "w");
                fwrite($fp, json_encode($array_json_user, JSON_UNESCAPED_UNICODE));
                fclose($fp);
                $no_errors [] = 'Файл успешно отправлен!';
                header("Refresh:3;http://$host$uri/list.php");
            }
        }
    }

    $exemple_file = "./exemple/exemple.json";
    $array_exemple = file_get_contents($exemple_file);
    $exeple = json_decode($array_exemple , true);

    function vardump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    };
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
<div class="form" id="admin">

    <?php if ( !empty($_SESSION['visitor']) ): ?>
    <div class="admin">
    <h1>Добро пожаловать <?= $_SESSION['visitor']['login'] ?></h1>
    <p><a href="list.php">Перейти к списку тестов</a></p>
    <p><a href="auth/logout.php">Выйти</a></p>
    </div>
    <?php endif ?>

    <?php if ( !empty($_SESSION['log_user']) ): ?>
        <div class="exemple">
            <p>Пример массива с тестом:</p>
            <?= vardump($exeple); ?>
        </div>
        <div class="admin">
        <h1>Добро пожаловать <?= $_SESSION['log_user']['login'] ?></h1>
        <form enctype="multipart/form-data" action="admin.php" method="POST">
            <lable for="file">Отправить готовый тест в JSON формате</lable><br />
            <input id="file" name="file" type="file" accept=".json"><br />
            <input type="submit" value="Отправить файл">
        </form>

        <?php
            if( !empty($errors) )
            {
                echo array_shift($errors);
            } elseif( !empty($no_errors) )
            {
                echo array_shift($no_errors);
            }
        ?>

        <p><a href="user_form.php">Создать тест</a></p>
        <p><a href="list.php">Перейти к списку тестов</a></p>
        <p><a href="auth/logout.php">Выйти</a></p>
        </div>
    <?php endif ?>
    
</div>
</body>
</html>