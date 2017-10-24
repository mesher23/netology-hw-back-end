<?php
require_once 'app/session.php';
session_destroy();
require_once './app/autoload.php';
require_once './app/classes/cart/CartClass.php';
require_once './app/classes/cart/CartClass.php';
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
    <?php
        $allPriceProductArr = [];
        for ($i=0; $i<$_SESSION['cartNumber']; $i++) {
            $priceProduct = $_SESSION['cart'.($i + 1)]['price']*$_SESSION['cart'.($i + 1)]['vol'];
            echo '<p>'.$_SESSION['cart'.($i + 1)]['brand'].': ';
            echo $priceProduct.' рублей</p>';
            echo '<a href="cart.php?del='.($i+1).'">Удалить из корзины</a>';
        }
    ?>
    <p>Общая сумма заказа: <?= \CartClass::$allPrice ?> рублей</p>
</div>
</body>
</html>
