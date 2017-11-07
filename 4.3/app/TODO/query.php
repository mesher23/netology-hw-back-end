<?php
/**
 * Файл в котором обрабатывается запрос пользователя
 */

$objDataBase = new classes\db\DataBase();
$errors = [];

/**
 * Проверка входящих данных
 */
$_POST['description'] = isset($_POST['description']) ? filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING) : '';
$valueTask = ['description' => $_POST['description'], 'button' => 'Добавить'];

if (isset($_GET['id'])) {
    if (is_numeric($_GET['id'])) {
        $getId = $_GET['id'];
    } else {
        header('Location:index.php');
    }
}

/**
 * Данные для вывода в таблицу в браузере
 *
 * Первая таблица
 */
$dataUserArr = $objDataBase->query("SELECT id, name FROM user");
if (!empty($_POST['sort'])) {
    if ($_POST['sort_by'] === 'date_added' || $_POST['sort_by'] === 'is_done' || $_POST['sort_by'] === 'description') {
        $sqlDataTODO = "SELECT t.id, t.user_id, t.assigned_user_id, t.date_added, t.is_done, t.description, u.name
                      FROM task t
                      INNER JOIN user u ON t.assigned_user_id = u.id
                      WHERE user_id LIKE :id
                      ORDER BY " . $_POST['sort_by'];
        $dataTODO = $objDataBase->query($sqlDataTODO, ["id" => $_SESSION['logUser']['id']]);
    }
} else {
    $sqlDataTODO = "SELECT t.id, t.user_id, t.assigned_user_id, t.date_added, t.is_done, t.description, u.name
                      FROM task t
                      INNER JOIN user u ON t.assigned_user_id = u.id
                      WHERE user_id LIKE :id";
    $dataTODO = $objDataBase->query($sqlDataTODO, ["id" => $_SESSION['logUser']['id']]);
}

/**
 * Вторая таблица
 */
if (!empty($_POST['sort_2'])) {
    if ($_POST['sort_by_2'] === 'date_added' || $_POST['sort_by_2'] === 'is_done' || $_POST['sort_by_2'] === 'description') {
        $sqlDataTODO_2 = "SELECT t.id, t.user_id, t.assigned_user_id, t.date_added, t.is_done, t.description, u.name
                      FROM task t
                      INNER JOIN user u ON t.assigned_user_id = u.id
                      WHERE assigned_user_id LIKE :id
                      ORDER BY " . $_POST['sort_by_2'];
        $dataTODO_2 = $objDataBase->query($sqlDataTODO_2, ["id" => $_SESSION['logUser']['id']]);
    }
} else {
    $sqlDataTODO_2 = "SELECT t.id, t.user_id, t.assigned_user_id, t.date_added, t.is_done, t.description, u.name
                      FROM task t
                      INNER JOIN user u ON t.assigned_user_id = u.id
                      WHERE assigned_user_id LIKE :id";
    $dataTODO_2 = $objDataBase->query($sqlDataTODO_2, ["id" => $_SESSION['logUser']['id']]);
}

/**
 * Запросы для работы пользователя с задачами
 *
 * 1) Пометить как выполненное
 * 2) Удалить
 * 3) Подготовить к редактированию
 */
if (isset($_GET['action']) && isset($_GET['id'])) {
    if ($_GET['action'] === 'done') {
        $sqlDone = "UPDATE task SET is_done = 1 WHERE id = " . $getId;
        $objDataBase->execute($sqlDone);
        header('Location:index.php');
    }

    if ($_GET['action'] === 'delete') {
        $sqlDelete = "DELETE FROM task WHERE id =" . $getId;
        $objDataBase->execute($sqlDelete);
        header('Location:index.php');
    }

    if ($_GET['action'] === 'edit') {
        $queryEdit = $objDataBase->query("SELECT description FROM task WHERE id = " . $getId);
        $valueTask = ['description' => $queryEdit[0]['description'], 'button' => 'Изменить'];
    }
}

/**
 * Запросы для создание и редактирование задач
 *
 * 1) Редактирование задачи
 * 2) Создание задачи
 */
if (!empty($_POST['save'])) {
    if (!empty($_POST['description'])) {
        if ($_GET['action'] === 'edit' && isset($_GET['id'])) {
            $sqlSave = "UPDATE task SET description = '" . $_POST['description'] . "' WHERE id = " . $getId;
            $objDataBase->execute($sqlSave);
            header('Location:index.php');
        } elseif ($_GET['action'] === 'edit' && !isset($_GET['id'])) {
            $errors [] = 'В запросе отсутствует идентификатор!';
        } else {
            $time = date('Y-m-d H:i:s');
            $sqlSaveValues = "( :user_id, :assigned_user_id, :description, :date_added)";
            $sqlSave = "INSERT INTO task (user_id, assigned_user_id, description, date_added) VALUES " . $sqlSaveValues;
            $sqlSaveArr = [
                'user_id' => $_SESSION['logUser']['id'],
                'assigned_user_id' => $_SESSION['logUser']['id'],
                'description' => $_POST['description'],
                'date_added' => $time
            ];
            $objDataBase->execute($sqlSave, $sqlSaveArr);
            header('Location:index.php');
        }
    } else {
        $errors [] = 'Введите описание задачи!';
    }
}

/**
 * Запрос для делегирование задач
 */
if (!empty($_POST['assigned_user_id'])) {
    $idUserAndTask = explode('&', $_POST['assigned_user_id']);
    $sqlAssigned = "UPDATE task SET assigned_user_id = :assigned_user_id WHERE id = :id";
    $sqlAssignedArr = [
        'assigned_user_id' => $idUserAndTask[0],
        'id' => $idUserAndTask[1]
    ];
    $objDataBase->execute($sqlAssigned, $sqlAssignedArr);
    header('Location:index.php');
}