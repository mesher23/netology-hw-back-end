<?php
require_once 'app/autoload.php';
require_once 'app/session.php';
require_once 'app/classes/cart/CartClass.php';
if (isset($_GET['id'])){
    $_GET['vol'] = isset($_GET['vol']) ? $_GET['vol'] : 1;
    $objCart = new \CartClass((int)$_GET['id'], $_GET['vol']);
}
var_dump(\CartClass::$allPrice);

$objFlowers = new classes\other\FlowersClass('Розы', 10);
$objFlowers1 = new classes\other\FlowersClass('Тюльпаны', 6);
$objFlowers2 = new classes\other\FlowersClass('Гвоздики', 16);
$objFlowers3 = new classes\other\FlowersClass('Исскуственная роза', 15);

$objPelmeni = new classes\food\PelmenisClass('Сибирские');
$objPelmeni1 = new classes\food\PelmenisClass('Русские');
$objPelmeni2 = new classes\food\PelmenisClass('Три богатыря');
$objPelmeni3 = new classes\food\PelmenisClass('Богатырские');

$objSugar = new classes\food\SugarClass('Cахарный песок', 10);
$objSugar1 = new classes\food\SugarClass('Кусковой сахар', 6);
$objSugar2 = new classes\food\SugarClass('Пальмовый сахар', 16);
$objSugar3 = new classes\food\SugarClass('Тростниковый сахар', 15);
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="/u/kotyukov/3.3/css/style.css" rel="stylesheet">
    <title>Домашние задание 3.3</title>
</head>
<body>
<div class="form">
    <p>Общая сумма заказа: <?= \CartClass::$allPrice ?> рублей</p>
    <p><a href="cart.php">В корзине: <?= $_SESSION['cartNumber'] ?></a></p>
    <div>
        <h2>Цветы:</h2>
        <p><?php $objFlowers->printProduct(); ?></p>
        <p><a href="index.php?id=1&vol=10">Добавить в корзину</a></p>
        <p><?php $objFlowers1->printProduct(); ?></p>
        <p><a href="index.php?id=2&vol=6">Добавить в корзину</a></p>
        <p><?php $objFlowers2->printProduct(); ?></p>
        <p><a href="index.php?id=3&vol=16">Добавить в корзину</a></p>
        <p><?php $objFlowers3->printProduct(); ?></p>
        <p><a href="index.php?id=4&vol=15">Добавить в корзину</a></p>
    </div>
    <div>
        <h2>Пельмени:</h2>
        <p><?php $objPelmeni->printProduct(); ?></p>
        <p><a href="index.php?id=5">Добавить в корзину</a></p>
        <p><?php $objPelmeni1->printProduct(); ?></p>
        <p><a href="index.php?id=6">Добавить в корзину</a></p>
        <p><?php $objPelmeni2->printProduct(); ?></p>
        <p><a href="index.php?id=7">Добавить в корзину</a></p>
        <p><?php $objPelmeni3->printProduct(); ?></p>
        <p><a href="index.php?id=8">Добавить в корзину</a></p>
    </div>
    <div>
        <h2>Сахар:</h2>
        <p><?php $objSugar->printProduct(); ?></p>
        <p><a href="index.php?id=9&vol=10">Добавить в корзину</a></p>
        <p><?php $objSugar1->printProduct(); ?></p>
        <p><a href="index.php?id=10&vol=6">Добавить в корзину</a></p>
        <p><?php $objSugar2->printProduct(); ?></p>
        <p><a href="index.php?id=11&vol=16">Добавить в корзину</a></p>
        <p><?php $objSugar3->printProduct(); ?></p>
        <p><a href="index.php?id=12&vol=15">Добавить в корзину</a></p>
    </div>
</div>
</body>
</html>
