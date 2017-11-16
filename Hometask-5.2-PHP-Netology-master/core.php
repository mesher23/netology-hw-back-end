<?php
session_start();
require_once 'config.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

function classAutoloadModel($className)
{
	$path = __DIR__.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$className.'.php';
	if (file_exists($path))
	{
		require_once $path;
	}
}

spl_autoload_register('classAutoloadModel');

function classAutoloadDatabase($className)
{
	$path = __DIR__.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$className.'.php';
	if (file_exists($path))
	{
		require_once $path;
	}
}

spl_autoload_register('classAutoloadDatabase');


function classAutoloadController($className)
{
	$path = __DIR__.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$className.'.php';
	if (file_exists($path))
	{
		require_once $path;
	}
}

spl_autoload_register('classAutoloadController');


$db = new DataBase($config['host'], $config['dbname'], $config['login'], $config['pass']);


$loader = new Twig_Loader_Filesystem(__DIR__.DIRECTORY_SEPARATOR.'template');
$twig = new Twig_Environment($loader, array(
	'cache' => '/tmp/cache',
	'auto_reload' => true
	));