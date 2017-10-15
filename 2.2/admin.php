<?php
$exemple_file = "./json/c2eefa41065d21c860b48f6cd425b0a2.json";
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
    <title>Домашние задание</title>
</head>
<body>
<div class="form" id="admin">
    <div class="exemple">
        <p>Пример массива с формой:</p>
        <?= vardump($exeple); ?>
    </div>
    <div class="admin">
    <form enctype="multipart/form-data" action="admin.php" method="POST">
        <lable for="file">Отправить готовую форму в JSON формате</lable><br />
        <input id="file" name="file" type="file" accept=".json"><br />
        <input type="submit" value="Отправить файл">
    </form>

    <?php
        if (isset($_FILES['file']['tmp_name']) === true) {
            $user_fail = file_get_contents($_FILES['file']['tmp_name']);
            $array_json_user = json_decode($user_fail, true);
                        
            foreach($array_json_user as $data_id => $value) {
                if (file_exists("./json/".md5($array_json_user["name"]).".json")) {
                echo 'Форма с таким именем уже есть! Придумаёте другое имя.';
                die;
                };
            };

            $file = "./json/".md5($array_json_user["name"]).".json";
            if (!file_exists($file)) {
                $fp = fopen($file, "w");
                fwrite($fp, json_encode($array_json_user, JSON_UNESCAPED_UNICODE));
                fclose($fp);
                echo 'Файл успешно отправлен!';
            };
        };
    ?>

    <p><a href="user_form.php">Создать форму</a></p>
    <p><a href="list.php">Перейти к списку форм</a></p>
    </div>
</div>
</body>
</html>