<?php

class Task
{
	private $connection = null;
	private $userId;

	public function __construct(PDO $connection, $userId)
	{
		$this->connection = $connection;
		$this->userId = $userId;
	}

	public function changeStatus($params) 
	{	
		extract($params);
		$updateStmt = $this->connection->prepare("UPDATE `task` SET `is_done` = :value  WHERE `id` = :id");
		$updateStmt->bindValue(':id', $id, PDO::PARAM_INT);
		$updateStmt->bindValue(':value', $value, PDO::PARAM_INT);
		$this->safeTransaction($updateStmt);
	}

	public function getInfoTaskTable($params)
	{
		extract($params);
		$selectStmt = $this->connection->prepare(
			"SELECT `description`, t.id AS `id`, `is_done`, u.login AS `author`, uu.login AS `userInCharge`, UNIX_TIMESTAMP(`date_added`) AS `date` "
			."FROM `task` AS `t` INNER JOIN `user` AS `u` ON t.user_id = u.id INNER JOIN `user` AS `uu` ON t.assigned_user_id = uu.id "
			."WHERE t.user_id = :userId ORDER BY $sort"
			);

		$selectStmt->bindValue(':userId', $this->userId);
		try {
			if ($selectStmt->execute()) $table = $selectStmt->fetchAll();
		} catch (PDOException $e) {exit('Ошибка при выполнении запроса');}
		return $table;
	}

	public function getInfoMyTaskTable($params)
	{
		extract($params);
		$selectStmt = $this->connection->prepare(
			"SELECT `description`, t.id AS `id`, `is_done`, u.login AS `author`, uu.login AS `userInCharge`, UNIX_TIMESTAMP(`date_added`) AS `date` "
			."FROM `task` AS `t` INNER JOIN `user` AS `u` ON t.user_id = u.id INNER JOIN `user` AS `uu` ON t.assigned_user_id = uu.id "
			."WHERE t.assigned_user_id = :userId AND t.user_id <> :userId ORDER BY $sort"
			);

		$selectStmt->bindValue(':userId', $this->userId);

		try {
			if ($selectStmt->execute()) $table = $selectStmt->fetchAll();
		} catch (PDOException $e) {exit('Ошибка при выполнении запроса');}
		return $table;
		
	}

	public function getAllUsers()
	{
		$selectStmt = $this->connection->query("SELECT * FROM `user`");
		$userList = $selectStmt->fetchAll();
		return $userList;
	}

	public function changeTaskDescription($params)
	{
		extract($params);
		$updateStmt = $this->connection->prepare("UPDATE `task` SET `description` = :description WHERE `id` = :id");
		$updateStmt->bindValue(':description', $description);
		$updateStmt->bindValue(':id', $id, PDO::PARAM_INT);
		$this->safeTransaction($updateStmt);
	}

	public function deleteTask($params)
	{
		extract($params);
		$deleteStmt = $this->connection->prepare("DELETE FROM `task` WHERE `id` = :id");
		$deleteStmt->bindValue(':id', $id, PDO::PARAM_INT);
		$this->safeTransaction($deleteStmt);
	}

	public function insertTask($params)
	{
		extract($params);
		$inputStmt = $this->connection->prepare(
			"INSERT INTO `task` (`user_id`, `assigned_user_id`, `description`, `is_done`) "
			."VALUES (:userId, :assignedUserId, :description, :is_done)"
			);

		$inputStmt->bindValue(':description', $description, PDO::PARAM_STR);
		$inputStmt->bindValue(':is_done', $is_done, PDO::PARAM_INT);
		$inputStmt->bindValue(':userId', $this->userId, PDO::PARAM_INT);
		$inputStmt->bindValue(':assignedUserId', $assignedUserId, PDO::PARAM_INT);

		$this->safeTransaction($inputStmt);
	}

	public function setUserInCharge($params)
	{
		extract($params);
		$updateStmt = $this->connection->prepare("UPDATE `task` SET `assigned_user_id` = :assignedUserId WHERE `id` = :taskId");
		$updateStmt->bindValue(':assignedUserId', $assignedUserId, PDO::PARAM_INT);
		$updateStmt->bindValue(':taskId', $id, PDO::PARAM_INT);
		$this->safeTransaction($updateStmt);
	}

	private function safeTransaction(PDOStatement $queryStmt)
	{
		$this->connection->beginTransaction();
		try {$queryStmt->execute();} catch (PDOException $e) {exit('Ошибка запроса');}

		if ($queryStmt->rowCount() > 1) { $this->connection->rollBack(); }

			$this->connection->commit();
	}

	
}


