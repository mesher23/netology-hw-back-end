<?php
$directory = './json';
$list_file = scandir($directory, 1);
$amount_of_elements = count($list_file);
$test_value = $amount_of_elements - 2;
$error = [];
function form_number() {
    echo '<form enctype="multipart/form-data" action="test.php" method="GET">';
    echo '<lable for="number">Введите номер формы:</lable>';
    echo '<input id="number" name="form" type="number" placeholder="">';
    echo '<input type="submit" value="Открыть"></form>';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашние задание</title>
</head>
<body>
<div class="form">

    <?php 
    if (isset($_GET['form']) === false) { 
        form_number();
    } elseif (isset($_GET['form']) === true) {
        if ($_GET['form'] >  $test_value ) {
            echo $error [] = 'Форма с таким номером не существует';
            form_number();
            die;
        } elseif ($_GET['form'] <= 0 ){
            echo $error [] = 'Форма с таким номером не существует';
            form_number();
            die;
        } else {
            foreach ($list_file as $id_data => $data) {
                if ($id_data === $_GET['form'] - 1) {
                    $array_form_json = file_get_contents('http://university.netology.ru/u/meshcheryakov/back/2.2/json/'.$data);
                    $array_form = json_decode($array_form_json, true);
                    break;
                };
            };
            echo '<form enctype="multipart/form-data" action="test.php?form='.$_GET['form'].'" method="POST">';
            echo '<h4>'.$array_form["name"].'</h4>';
            $id = 0;
            $number_array_form = (count($array_form) - 2) / 3;
            for ( $x=0; $x < $number_array_form; ++$x) {
    ?>
                <lable for="input<?= $id ?>"><?= $array_form ['text'.$id] ?></lable><br />
                <input id="input<?= $id ?>" name="<?= 'name'.$id ?>" type="<?= $array_form ['type'.$id] ?>" placeholder="<?= $array_form ['placeholder'.$id] ?>" ><br />
    <?php
                ++$id;
            };
            echo '<br /><input type="submit" value="отправить"></form>';
        };
        echo '<p><a href="list.php">Вернутся к списку форм</a></p>';
    };
    if (isset($_POST['name'.($id-1)]) === true) {
        if ($_POST['name'.($id-1)] === $array_form["result"]){
            echo  'Форма успешно отправлена!';
        } else {
            echo  'Неправильный ответ!';
        }
    };
    ?>

</div>
</body>
</html>