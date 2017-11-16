<?php

class User 
{
	private $id;
	private $login;
	private $authorized = false;
	private $connection;

	public function __construct(PDO $db)
	{
		$this->authorizeFromSession();
		$this->connection = $db;
	}

	private function authorizeFromSession()
	{
		if (isset($_SESSION['userId'], $_SESSION['userLogin']))
		{
			$this->login = $_SESSION['userLogin'];
			$this->id = $_SESSION['userId'];
			$this->authorized = true;
		} 
	}

	public function logIn($params)
	{
		extract($params);
		if ($userInfo = $this->getUserData($login))
		{
			extract($userInfo, EXTR_PREFIX_ALL, 'db');

			if (password_verify($password, $db_password)) //hash_equals() - не работает на Нетологии
			{
				$_SESSION['userId'] = $db_id;
				$_SESSION['userLogin'] = $db_login;

				$this->authorizeFromSession();
				return '1';
				
			} else return '0';
		}
		return '0';
	}


	private function getUserData($login)
	{
		$selectStmt = $this->connection->prepare("SELECT * FROM `user` WHERE `login` = :login");
		$selectStmt->bindValue(':login', $login);

		if ($selectStmt->execute())
		{
			if ($selectStmt->rowCount() === 1)
			{
				$userInfo = $selectStmt->fetchAll()[0];
				return $userInfo;
			}
		}

		return false;
	}

	public function checkLogIn($params = null)
	{
		$status = (int) $this->authorized;
		return (string) $status;
	}

	public function __get($property)
	{
		return $this->$property;
	}

	private function checkUserExist($login)
	{
		$selectStmt = $this->connection->prepare("SELECT * FROM `user` WHERE `login` = :login");
		$selectStmt->bindValue(':login', $login);

		if ($selectStmt->execute())
		{
			if ($selectStmt->rowCount() !== 0)
			{
				return true;
			}
		}

		return false;

	}

	public function register($params)
	{
		extract($params);
		if ($this->checkUserExist($login))
		{
			return '7';
		}

		$insertStmt = $this->connection->prepare("INSERT INTO `user` (`login`, `password`) VALUES (:login, :password)");

		$insertStmt->bindValue(':login', $login);

		$hashPassword = password_hash($password, PASSWORD_BCRYPT);
		$insertStmt->bindValue(':password', $hashPassword);

		$this->connection->beginTransaction();

		if ($insertStmt->execute())
		{
			if ($insertStmt->rowCount() > 1)
			{
				$this->connection->rollBack();
				$this->connection->commit();
				return '0';
			}

			$this->connection->commit();

			//$_SESSION['userId'] = $this->connection->lastInsertId();
			//$_SESSION['userLogin'] = $login;

			$this->authorizeFromSession();

			return '1';
		}

		$this->connection->commit();
		return '0';
	}

	public function logOut($params = null)
	{
		session_destroy();
	}

}