<?php

//Записываем в переменные api ключ и город, в котором мы хотим узнать погоду
$appid = '67354425604153dab12d8d2143fb62c6';
$cityname = 'Kazan';

$weather = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q={$cityname}&units=metric&APPID={$appid}");
$array_weather = json_decode ($weather, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>weatherapi</title>
</head>
<body>
<div>
    <h1>Weather and forecasts in <?= $array_weather["name"].', '.$array_weather["sys"]["country"] ?></h1>
    <p id="date"><?= date('l jS \of F Y') ?></p>
    <p id="img"><img src="<?= 'http://openweathermap.org/img/w/' .$array_weather["weather"][0]["icon"] .'.png' ?>" alt=""></p>
    <p class="condition"><?= round($array_weather["main"]["temp"] - 273.15, 2).' °C' ?></p>
    <p class="condition"><?= $array_weather["wind"]["speed"].'m/s' ?></p>
    <p class="condition"><?= round($array_weather["main"]["pressure"], 1) ?></p>
    <p id="humidity"><?= 'Влажность: '.round($array_weather["main"]["humidity"]).'%' ?></p>
</div>
</body>
</html>