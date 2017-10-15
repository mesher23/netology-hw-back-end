<?php
    require_once './auth/functions.php';
    if ( empty($_SESSION['log_user']) && empty($_SESSION['visitor']) )
    {
        redirect('u/meshcheryakov/back/2.4/index.php');
    }
    
    $directory = './json';
    $list_file = scandir($directory, 1);
    $amount_of_elements = count($list_file);
    $test_value = $amount_of_elements - 2;
    $error = 0;

    if (isset($_GET['form']) === false) 
    { 
        $error = 1;
    } elseif (isset($_GET['form']) === true) 
    {
        if ($_GET['form'] <= 0) 
        {
            $error = 2;
            header("HTTP/1.0 404 Not Found");
        } elseif ($_GET['form'] >  $test_value) 
        {
        $error = 2;
        header("HTTP/1.0 404 Not Found");
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
    if ($error === 1):
        form_number();
    elseif ($error === 2):
        echo 'Тест с таким номером не существует';
        form_number();
        die;
    else:
        foreach ($list_file as $id_data => $data):
            if ($id_data === $_GET['form'] - 1):
                $array_form_json = file_get_contents('./json/'.$data);
                $array_form = json_decode($array_form_json, true);
                break;
            endif;
        endforeach;
    ?>
        <form enctype="multipart/form-data" action="test.php?form=<?= $_GET['form'] ?>" method="POST">
        <h4><?= $array_form["name"] ?></h4>
    <?php
        $id = 0;
        $number_array_form = (count($array_form) - 2) / 3;
        for ( $x=0; $x < $number_array_form; ++$x):
    ?>
            <lable for="input<?= $id ?>"><?= $array_form ['text'.$id] ?></lable><br />
            <input id="input<?= $id ?>" name="<?= 'name'.$id ?>" type="<?= $array_form ['type'.$id] ?>" placeholder="<?= $array_form ['placeholder'.$id] ?>" ><br />
    <?php
                ++$id;
            endfor;
            echo '<br /><input type="submit" value="отправить"></form>';
        endif;


        if (isset($_POST['name'.($id-1)]) === true)
        {
            if ($_POST['name'.($id-1)] === $array_form["result"])
            {
                if ( !empty($_SESSION['visitor']) )
                {
                    echo '<p><img src="http://university.netology.ru/user_data/meshcheryakov/back/2.4/img/img.php?text=';
                    echo $_SESSION['visitor']['login'];
                    echo '" id="certificate"></a></p>';
                } else
                {
                    echo '<p><img src="http://university.netology.ru/user_data/meshcheryakov/back/2.4/img/img.php?text=';
                    echo $_SESSION['log_user']['login'];
                    echo '" id="certificate"></a></p>';
                }
            } else 
            {
                echo  'Неправильный ответ!';
            }
        }
    ?>

    <p><a href="list.php">Вернутся к списку тестов</a></p>
    <p><a href="auth/logout.php">Выйти</a></p>
</div>
</body>
</html>