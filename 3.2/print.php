<?php
require_once './class/flowers.php';
require_once './class/pelmenis.php';
require_once './class/sugar.php';

$objFlowers = new FlowersClass('Розы', 10);
$objFlowers1 = new FlowersClass('Тюльпаны', 6);
$objFlowers2 = new FlowersClass('Гвоздики', 16);
$objFlowers3 = new FlowersClass('Исскуственная роза', 15);

$objPelmeni = new PelmenisClass('Сибирские');
$objPelmeni1 = new PelmenisClass('Русские');
$objPelmeni2 = new PelmenisClass('Три богатыря');
$objPelmeni3 = new PelmenisClass('Богатырские');

$objSugar = new SugarClass('Cахарный песок', 10);
$objSugar1 = new SugarClass('Кусковой сахар', 6);
$objSugar2 = new SugarClass('Пальмовый сахар', 16);
$objSugar3 = new SugarClass('Тростниковый сахар', 15);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="/u/meshcheryakov/back/3.2/css/style.css" rel="stylesheet">
    <title>Домашние задание 2.4</title>
</head>
<body>
<div class="form">
    <div>
        <h2>Цветы:</h2>
        <p><?php $objFlowers->printProduct(); ?></p>
        <p><?php $objFlowers1->printProduct(); ?></p>
        <p><?php $objFlowers2->printProduct(); ?></p>
        <p><?php $objFlowers3->printProduct(); ?></p>
    </div>
    <div>
        <h2>Пельмени:</h2>
        <p><?php $objPelmeni->printProduct(); ?></p>
        <p><?php $objPelmeni1->printProduct(); ?></p>
        <p><?php $objPelmeni2->printProduct(); ?></p>
        <p><?php $objPelmeni3->printProduct(); ?></p>
    </div>
    <div>
        <h2>Сахар:</h2>
        <p><?php $objSugar->printProduct(); ?></p>
        <p><?php $objSugar1->printProduct(); ?></p>
        <p><?php $objSugar2->printProduct(); ?></p>
        <p><?php $objSugar3->printProduct(); ?></p>
    </div>
</div>

</body>
</html>
