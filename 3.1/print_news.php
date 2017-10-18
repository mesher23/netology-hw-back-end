<?php
require_once 'news.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Домашние задание 3.1</title>
</head>
<body>
<div class="form">
    <?php
    $news = new PostNewsClass(0);
    $news->printNews();
    ?>
</div>
</body>
</html>