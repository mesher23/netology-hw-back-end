<?php
	$userName = 'Никита';
	$userAge = 22;
	$userMail = 'mesher23@gmail.com';
	$userCity = 'Казань';
	$userJob = 'Студент, Гений, Миллионер, Плейбой, Филантроп';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<h1>Информация о пользователе: <?= $userName ?></h1>
	<p>Имя: <?= $userName ?>.</p>
	<p>Возраст: <?= $userAge ?> лет.</p>
    <p>Адрес электронной почты: <?= $userMail ?>.</p>
	<p>Живу в городе: <?= $userCity ?>.</p>
	<p>О себе: <?= $userJob ?></p>


</body>
</html>