<?php
require_once 'app/session.php';
require_once 'app/autoload.php';

$obj = new \classes\appliances\Appliances();
$obj1 = new \classes\clothing\Clothing();
$obj2 = new \classes\telephones\Telephones();
$obj3 = new \classes\furniture\Furniture();
$objCart = new \classes\cart\Cart();
if (isset($_GET['id'])) {
    $_GET['vol'] = isset($_GET['vol']) ? $vol : 1;
    $objCart->addProduct($_GET['id'], $_GET['vol']);
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Домашние задание 3.3</title>
</head>
<body>
<div class="form">
    <p>
        <a href="order.php">Корзина: <?= $_SESSION['cartNumber'] ?></a>
        <p>Общая сумма: <?= $_SESSION['cartPrice'] ?></p>
    </p>
    <div>
        <?php
        $obj->printProduct();
        ?>
    </div>
    <div>
        <?php
        $obj1->printProduct();
        ?>
    </div>
    <div>
        <?php
        $obj2->printProduct();
        ?>
    </div>
    <div>
        <?php
        $obj3->printProduct();
        ?>
    </div>
</div>
</body>
</html>
