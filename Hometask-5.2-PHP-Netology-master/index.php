<?php 
require_once 'core.php';

$user = new User($db->connection);
$task = new Task($db->connection, $user->id);
$userList = $task->getAllUsers();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Домашнее задание к лекции 5.2 «Шаблонизатор Twig»</title>
	<script src="scripts/jquery-1.12.4.js"></script>
	<script src="scripts/jquery-ui.js"></script> 
	<script src="scripts/script.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h2>Домашнее задание к лекции 5.2 «Шаблонизатор Twig»</h2>
			<form id="authorizationform">
				<div>
					<label for="login"></label>
					<input type="text" name="login"  value="" placeholder="Логин" />

					<label for="password"></label>
					<input type="password" name="password"  value="" placeholder="Пароль" />
				
					<input type="button" value="Войти" id="authorize" onclick="logIn()"/>
					<input type="button" value="Регистрация"  onclick="register()"/>
				</div>
			</form>

	<div id="errorsection"></div>

<div id="usercontent" style="display: none;">
		<form id="taskaddform" class="taskaddform">
		<div>
			<label for="description"></label>
			<input class="descriptionfield" required type="text" name="description" id="description" value="" placeholder="Описание задачи" />
			<div style="display: inline-block;">
				<input checked type="radio" name="is_done" id="is_done_1"  value="0" />
				<label for="is_done_1">Не выполнена</label>
				<br>
				<input type="radio" name="is_done" id="is_done_2" value="1" />
				<label for="is_done_2">Выполнена</label>

			</div>

			<label>Выбрать ответственного:</label>
			<select name="assignedUserId" >
				<?php foreach ($userList as $user): extract($user);?>
					<option value="<?=$id?>" ><?=htmlspecialchars($login)?></option>
				<?php endforeach; ?>
			</select>

			<input id="taskaddbutton" type="button" value="Добавить" onclick="insertTask()" />
		</div>
	</form>


	<form id="sortform">
		<div>
			<label for="sort">Сортировать по:</label>
			<select name="sort" id="sort">
				<option value="date_added DESC">Дате</option>
				<option value="description">Описанию</option>
				<option value="is_done">Статусу</option>
			</select>
		
			<input id="sortbutton" type="button" value="Submit" onclick="sortTasks()" />
		</div>
	</form>

	<div id="tableholder"></div>

	<br>
	<input type="button" value="Выход" id="endsession" onclick="logOut()">
</div>
</body>
</html>

