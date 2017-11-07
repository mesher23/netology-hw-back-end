<?php
/**
 * Файл в котором обрабатывается запрос пользователя
 */

require_once 'db_connect.php';
$objDataBase = new DataBase();
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
 */
if (isset($_POST['sort'])) {
    if ($_POST['sort_by'] === 'date_added' || $_POST['sort_by'] === 'is_done' || $_POST['sort_by'] === 'description') {
        $dataTODO = $objDataBase->query("SELECT * FROM `tasks` ORDER BY" . "`" . $_POST['sort_by'] . "`");
    }
} else {
    $dataTODO = $objDataBase->query("SELECT * FROM `tasks`");
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
        $sqlDone = "UPDATE `tasks` SET `is_done` = 1 WHERE `id` LIKE :id";
        $objDataBase->execute($sqlDone, ["id" => $getId]);
        header('Location:index.php');
    }

    if ($_GET['action'] === 'delete') {
        $sqlDelete = "DELETE FROM `tasks` WHERE `id` LIKE :id";
        $objDataBase->execute($sqlDelete, ["id" => $getId]);
        header('Location:index.php');
    }

    if ($_GET['action'] === 'edit') {
        $queryEdit = $objDataBase->query("SELECT `description` FROM `tasks` WHERE `id` LIKE :id", ["id" => $getId]);
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
            $sqlSave = "UPDATE `tasks` SET `description` = :description WHERE `id` LIKE :id";
            $objDataBase->execute($sqlSave, [
                "description" => $_POST['description'],
                "id" => $getId
            ]);
            header('Location:index.php');
        } elseif ($_GET['action'] === 'edit' && !isset($_GET['id'])) {
            $errors [] = 'В запросе отсутствует идентификатор!';
        } else {
            $time = date('Y-m-d H:i:s');
            $sqlSave = "INSERT INTO `tasks` (`description`,`date_added`) VALUES ( :description, :date_added)";
            $objDataBase->execute($sqlSave, [
                "description" => $_POST['description'],
                "date_added" => $time
            ]);
            header('Location:index.php');
        }
    } else {
        $errors [] = 'Введите описание задачи!';
    }
}

