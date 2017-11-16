<?php

class TaskController
{
	private $model = null;

	public function __construct(PDO $db)
	{
		$user = new User($db);
		if (!$user->checkLogIn()) exit;
		$this->model = new Task($db, $user->id);
	}

	private $params =
	[
		'changeStatus' => [ 'params' => ['id' => 0, 'value' => 0], 'method' => 'GET'],
		'getInfoMyTaskTable' => ['params' => ['sort' => 0], 'method' => 'POST'],
		'getInfoTaskTable' => ['params' => ['sort' => 0], 'method' => 'POST'],
		'changeTaskDescription' => ['params' => ['id' => 0, 'description' => 0], 'method' => 'POST'],
		'deleteTask' => ['params' => ['id' => 0], 'method' => 'GET'],
		'insertTask' => ['params' => ['assignedUserId' => 0, 'description' => 0, 'is_done' => 0], 'method' => 'POST'],
		'setUserInCharge' => ['params' => ['assignedUserId' => 0, 'id' => 0], 'method' => 'GET']
	];


	function checkData($inputArray, $neededValues, $method = 'GET')
	{
		$checkedArray = array();
		$intKeys = array('id', 'year', 'value');

		if ($method === 'GET') $filterMethod = INPUT_GET; else $filterMethod = INPUT_POST;

		$optionsInt =
		[
			'options' =>
			[
				'default' => -1,
				'min_range' => 0
			]

		];

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
			if ($value === '') continue;

			if (in_array($key, $intKeys))
			{
				if (($num = filter_input($filterMethod, $key, FILTER_VALIDATE_INT, $optionsInt)) !== -1)
				{
					$checkedArray[$key] = $num;
				}

			} else
			{
				$checkedArray[$key] = filter_input($filterMethod, $key, FILTER_SANITIZE_SPECIAL_CHARS, $optionsStr);
			}
		}

		if (count(array_diff_key($neededValues, $checkedArray)) === 0 )
		{
			return $checkedArray;
		} 

		return false;
	}

	public function __get($property)
	{
		return $this->$property;
	}
}