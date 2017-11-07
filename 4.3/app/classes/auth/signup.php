<?php
/**
 * Файл регистрации
 */
$objDataBase = new classes\db\DataBase();

/**
 * Подготовка данных
 */
$data = $_POST;
$data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$data['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$data['name'] = trim($data['name']);
$data['login'] = trim($data['login']);

/**
 * Обработка данных
 */
if (isset($data["go_regist"])) {
    $errors = [];
    $doneRegist = '';

    if ($data["name"] == '') {
        $errors [] = 'Введите имя!';
    }

    if ($data["login"] == '') {
        $errors [] = 'Введите логин!';
    }

    if (isset($data['login'])) {
        if (!(preg_match('/^[a-zA-Z0-9]+$/', trim($data['login'])))) {
            $errors [] = 'Логин должен состоять только из цифр и букв латинского алфавита!';
        }
    }

    if (strlen($data['login']) < 5) {
        $errors [] = 'Логин должен состоять не менеe чем из 5 символов!';
    }

    if (isset($data["login"])) {
        $sqlLoginTest = "SELECT login FROM user WHERE login LIKE :login";
        $sqlLoginTestArr = ["login" => $data["login"]."%"];
        if (!empty($objDataBase->query($sqlLoginTest, $sqlLoginTestArr))) {
            $errors [] = 'Пользователь с таким именем уже существует!';
        }
    }

    if ($data["password"] == '') {
        $errors [] = 'Введите пароль!';
    }

    if (trim($data["password_2"]) != trim($data["password"])) {
        $errors [] = 'Повторный пароль не совпадает с первым!';
    }

    /**
     * Регистрация пользователя и запись данных в БД
     */
    if (empty($errors)) {
        $data['password'] = password_hash(trim($data['password']), PASSWORD_DEFAULT);
        $sqlSignUp = "INSERT INTO user (login, password, name) VALUES ( :login, :password, :name)";
        $sqlSignUpArr = [
            "login" => $data["login"],
            "password" => $data["password"],
            "name" => $data["name"]
        ];
        $objDataBase->execute($sqlSignUp, $sqlSignUpArr);
        $_SESSION['regist'] = 1;
        header('Location: '.explode('?', $_SERVER['HTTP_REFERER'])[0].'?login=login');
        die;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Регистрация</title>
</head>
<body>
<div class="form">
    <?php
    if (!empty($errors)):
        echo '<p style="color: red;">' . array_shift($errors) . '</p>';
    endif;
    ?>
    <form method="POST">
        <p>
            <label id="name">Вашe имя:</label>
            <br/>
            <input id="name" type="text" name="name" value="<?= @$data["name"] ?>" placeholder="Евгений">
        </p>
        <p>
            <label id="login">Ваш логин:</label>
            <br/>
            <input id="login" type="text" name="login" value="<?= @$data["login"] ?>" placeholder="admin">
        </p>
        <p>
            <label id="password">Ваш пароль:</label>
            <br/>
            <input id="password" type="password" name="password">
        </p>
        <p>
            <label id="password_2">Повторите пароль:</label>
            <br/>
            <input id="password_2" type="password" name="password_2">
        </p>
        <p>
            <input type="submit" name="go_regist" value="Зарегистрироватся">
        </p>
    </form>
</div>
</body>
</html>
