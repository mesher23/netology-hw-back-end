<?php
Error_reporting(E_ALL);
echo "<h1>Телефонная книга</h1>";
echo "<br/>";
$content = file_get_contents ('json_phone.json');
$decodeData = json_decode ($content, true);
$counter = count($decodeData);
for ($i=0; $i<$counter; $i++)  {
    echo "<h2>Контакт № ".$j = $i + "1"."</h2>";
    echo "Имя: "."<i>".$decodeData["$i"]["firstName"]."</i>";
    echo "<br/>";
    echo "Фамилия: "."<i>".$decodeData["$i"]["lastName"]."</i>";
    echo "<br/>";
    echo "Город: "."<i>".$decodeData["$i"]["adress"]["city"]."</i>";
    echo "<br/>";
    echo "Адрес: "."<i>".$decodeData["$i"]["adress"]["streetAddress"]."</i>";
    echo "<br/>";
    echo "Тел.1: "."<i>".$decodeData["$i"]["phoneNumbers"]["0"]."</i>";
    echo "<br/>";
    echo "Тел.2: "."<i>".$decodeData["$i"]["phoneNumbers"]["1"]."</i>";
}
?>