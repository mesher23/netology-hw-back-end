<?php
error_reporting(E_ALL);

require_once '../../core.php';

$action = $_GET['action'];
unset($_GET['action']);

$controller = $_GET['controller'];
unset($_GET['controller']);

$controller = ucfirst($controller) . 'Controller';
$ControllerClass = new $controller($db->connection);

if ($data = $ControllerClass->checkData($_POST, $ControllerClass->params[$action]['params'], $ControllerClass->params[$action]['method']) )
{
	$model = $ControllerClass->model;
	$result = $model->$action($data);
	
	if (is_string($result))
	{
		echo $result;
	}

	if (is_array($result))
	{
		$userList = $model->getAllUsers();
		$params['result'] = $result;
		$params['userList'] = $userList;
		$params['currentUser'] = $_SESSION['userLogin'];
		$template = $twig->load($action . '.html');
		$template->display($params);
	}
	
	return;
} 

if ($data = $ControllerClass->checkData($_GET, $ControllerClass->params[$action]['params'], $ControllerClass->params[$action]['method']) )
{
	$model = $ControllerClass->model;
	$result = $model->$action($data);

	if (is_string($result))
	{
		echo $result;
	}
} 