<?php
    require_once './auth/functions.php';
    if ( empty($_SESSION['log_user']) && empty($_SESSION['visitor']) )
    {
        redirect('u/meshcheryakov/back/2.4/index.php');
    }
    
    $directory = './json';
    $list_file = scandir($directory, 1);
    $amount_of_elements = count($list_file);
    $id_file = 1;

    if ( isset($_POST['delete_test']) )
    {
        delete_test($_POST['delete_num']);
        redirect('u/meshcheryakov/back/2.4/list.php');
        die;
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
        foreach ($list_file as $id_data => $data)
        {
            if ($id_data < $amount_of_elements - 2)
            {
                $array_form_json = file_get_contents('./json/'.$data);
                $array_form = json_decode($array_form_json, true);
                echo '<p>' .$id_file .') ' .$array_form['name'] .'</p>';
                ++$id_file;
            }
        }
    ?>

    <form action="test.php" method="GET">
        <lable for="number">Введите номер теста:</lable>
        <input id="number" name="form" type="number" placeholder="">
        <input type="submit" value="Открыть">
    </form>

    <?php if ( !empty($_SESSION['log_user']) ): ?>

        <form action="list.php" method="post">
        <lable for="delete_num">Введите номер теста который хотите удалить:</lable>
        <input id="delete_num" name="delete_num" type="number" placeholder="">
        <input type="submit" value="Удалть" name="delete_test">
        </form>

    <?php endif ?>

    <p><a href="admin.php">Вернутся к главной странице</a></p>
    <p><a href="auth/logout.php">Выйти</a></p>
</div>
</body>
</html>