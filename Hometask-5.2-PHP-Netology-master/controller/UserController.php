<?php

class UserController
{
	private $model = null;

	private $params =
	[
		'logIn' => [ 'params' => ['login' => 0, 'password' => 0], 'method' => 'POST'],
		'register' => [ 'params' => ['login' => 0, 'password' => 0], 'method' => 'POST'],
		'logOut'  => [ 'params' => [], 'method' => 'GET'],
		'checkLogIn' => ['params' => [], 'method' => 'GET']
	];


	public function __construct(PDO $db)
	{
		$this->model = new User($db);
	}


	public function checkData($inputArray, $neededValues, $method = 'GET')
	{
		$checkedArray = array();

		if ($method === 'GET') $filterMethod = INPUT_GET; else $filterMethod = INPUT_POST;

		$optionsStr = 
		[
			'flags' => [FILTER_FLAG_STRIP_HIGH]
		];


		if ($_SERVER['REQUEST_METHOD'] !== $method)
		{
			return false;
		}

		foreach ($inputArray as $key => $value)
		{

			$checkedArray[$key] = filter_input($filterMethod, $key, FILTER_SANITIZE_SPECIAL_CHARS, $optionsStr);
		}

		if (count(array_diff_key($neededValues, $checkedArray)) === 0 )
		{
			if (!$checkedArray) return true; // для некоторых методов передаваемых переменных нет и возвращается пустой массив, однако он интерпретируется как false, хотя на деле проверка прошла успешно. !пустой_массив = true
			return $checkedArray;
		} 

			return false;
	}

	public function __get($property)
	{
		return $this->$property;
	}
}