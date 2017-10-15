<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);

$error = [];
if (isset($_POST['number']) === true) {
    $number_post = $_POST['number'];
} else {
    $number_post = null;
};
$test_number = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашние задание 2.3</title>
</head>
<body>
<div class="form">

        <form enctype="multipart/form-data" action="user_form.php" method="POST">
            <lable for="number">Сколько пунктов будет в тесте: </lable>
            <input id="number" name="number" type="number" placeholder="Не более 5">
            <input type="submit" value="Создать">
        </form>
            
            <?php 
            if ($number_post === null) {
            } elseif ($number_post > 5) {
                echo $error[] = 'Количестов пунтков должно быть меньше 5';
            } elseif ($number_post < 1) {
                echo $error[] = 'Количестов пунтков не может быть меньше 1';
            } else {
            ?>

            <h6>
            Ответ на вопрос который вы запишите будет проверятся в последнем пункте.<br />
            То есть последний пункт должен содержать вопрос, на который надо ответь. Ответ может быть как число так и слово.<br />
            </h6>
            <form id="form_user" enctype="multipart/form-data" action="user_form.php" method="POST">
            <lable for="name">Введите имя теста: </lable>
            <input id="name" name="name" type="text" placeholder="Тест №1"><br />
            <lable for="result">Ответ который должен проверить сервер: </lable>
            <input id="result" name="result" type="text" placeholder="Пример: 10"><br />

            <?php for ( $x = 0; $x < $_POST['number']; ++$x ) { ?>

                <br />
                <lable for="type<?= $x ?>">Тип данных в <?= $x + 1 ?> пункте</lable><br />
                <input id="type<?= $x ?>" name="type<?= $x ?>" type="radio" value="text">Текст<br />
                <input id="type<?= $x ?>" name="type<?= $x ?>" type="radio" value="number">Число<br />
                <input id="type<?= $x ?>" name="type<?= $x ?>" type="radio" value="email">Email адрес<br />
                <input id="type<?= $x ?>" name="type<?= $x ?>" type="radio" value="url">URL адрес<br />
                <lable for="text<?= $x ?>">Заголовок в <?= $x + 1 ?> пункте</lable>
                <input id="text<?= $x ?>" name="text<?= $x ?>" type="text" placeholder="Заголовок <?= $x + 1 ?>"><br />
                <lable for="placeholder<?= $x ?>">Placeholder в <?= $x + 1 ?> пункте</lable>
                <input id="placeholder<?= $x ?>" name="placeholder<?= $x ?>" type="text" placeholder="Placeholder <?= $x + 1 ?>"><br />

            <?php
                ++$test_number; 
                };
                echo '<input type="submit" value="Создать"></form>';
                $array_form_user = [];
            }; 

            if (count($_POST) > 1) {
                foreach($_POST as $data_id => $value) {
                    if (count($_POST) < 3 * ($test_number + 1) +1 ) {
                        echo $error [] = 'Не все пункты были отмечены';
                        die;
                    } elseif ($value === '') {
                        echo $error [] = 'Не все пункты были заполнены';
                        die;
                    } elseif (file_exists("./json/".md5($_POST["name"]).".json")) {
                        echo $error [] = 'Тест с таким именем уже есть! Придумаёте другое имя.';
                        die;
                    } else {
                        $array_form_user [$data_id] = $value;
                    };
                };

            $file = "./json/".md5($array_form_user["name"]).".json";
            if (!file_exists($file)) {
                $fp = fopen($file, "w");
                fwrite($fp, json_encode($array_form_user, JSON_UNESCAPED_UNICODE));
                fclose($fp);
            };
            echo 'Тест успешно создан';
            echo '<p><a href="list.php">Перейти к списку тестов</a></p>';
            };
            ?>
</div>
</body>
</html>