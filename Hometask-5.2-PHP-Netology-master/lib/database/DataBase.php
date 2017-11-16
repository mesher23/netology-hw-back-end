<?php

class DataBase
{
	private $connection = null;

	public function __construct($host, $dbname, $login, $password)
	{
		try {
			$this->connection = new PDO('mysql:dbname='.$dbname.';host='.$host, $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
		} catch (PDOException $e) { exit('Не удалось подключиться к базе данных.');}
		
		$this->connection->query('SET NAMES utf8');
	}

	public function __get($property)
	{
		return $this->$property;
	}

}