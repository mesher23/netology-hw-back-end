<?php
/**
 * Файл в котором обрабатывается запрос пользователя
 */

namespace classes\query;

use classes\db\DataBase;

class Query
{
    public $getTables;
    public $infoTable;

    /**
     * Query constructor.
     */
    public function __construct()
    {
        $objDataBase = new DataBase();
        $this->UserQuery($objDataBase);
    }

    /**
     * Подключается запросы
     *
     * @param $objDataBase
     */
    private function UserQuery($objDataBase)
    {
        $this->getTables($objDataBase);
        if (!empty($_POST) || !empty($_GET)) {
            $this->infoTable($objDataBase);
            $this->createTable($objDataBase);
            $this->deleteColumn($objDataBase);
            $this->settingsTable($objDataBase);
        }
    }

    /**
     * Получает массив с таблицами
     *
     * @param $objDataBase
     */
    private function getTables($objDataBase)
    {
        $tableArray = $objDataBase->query("SHOW TABLES");
        $this->getTables = $tableArray;
    }

    /**
     * Создаёт таблицу
     *
     * @param $objDataBase
     */
    private function createTable($objDataBase)
    {
        if (isset($_POST['creatTable'])) {
            $_POST['table'] = isset($_POST['table']) ? filter_input(INPUT_POST, 'table', FILTER_SANITIZE_STRING) : '';
            if ($_POST['table'] == '') {
                $errors [] = 'Введите имя таблицы!';
            }

            if (!(preg_match('/^[a-z0-9A-Z]+$/', $_POST['table']))) {
                $errors [] = 'Имя таблицы должено состоять только из букв латинского алфавита!';
            }

            if (empty($errors)) {
                var_dump($_POST['table']);
                $sqlCreatTable = "CREATE TABLE IF NOT EXISTS " . $_POST['table'] . " (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `colum1` text NOT NULL,
                            `colum2` text NOT NULL,
                            `colum3` text NOT NULL,
                            `colum4` text NOT NULL,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                $objDataBase->execute($sqlCreatTable);
                header('Location:index.php?table=' . $_GET['table']);
            }
        }
    }

    /**
     * Получает информацию о таблице
     *
     * @param $objDataBase
     */
    private function infoTable($objDataBase)
    {
        if (!empty($_GET['table'])) {
            $sqlTable = "DESCRIBE " . $_GET['table'];
            $table = $objDataBase->query($sqlTable);
            $this->infoTable = $table;
        }
    }

    /**
     * Удаляет поле
     *
     * @param $objDataBase
     */
    private function deleteColumn($objDataBase)
    {
        if (!empty($_GET['deleteColumn'])) {
            $sqlDeleteColumn = "ALTER TABLE " . $_GET['table'] . " DROP COLUMN " . $_GET['deleteColumn'];
            $objDataBase->execute($sqlDeleteColumn);
            header('Location:index.php?table=' . $_GET['table']);
        }
    }

    /**
     * Меняет имя таблици и имена полей
     *
     * @param $objDataBase
     */
    private function settingsTable($objDataBase)
    {
        if (!empty($_POST['nameTable'])) {
            if ($_GET['table'] !== $_POST['nameTable']) {
                $sqlRenameTable = "ALTER TABLE " . $_GET['table'] . " RENAME " . $_POST['nameTable'];
                $objDataBase->execute($sqlRenameTable);
            }

            $arrayTypeAndNameColumn = [];
            $idColumn = 0;
            foreach ($_POST as $keyColumn => $dataColumn) {
                if (strpos($keyColumn, 'nameColumn') !== false) {
                    $arrayTypeAndNameColumn['column' . $idColumn]['nameColumn'] = $dataColumn;
                } elseif (strpos($keyColumn, 'OldNameColumn') !== false) {
                    $arrayTypeAndNameColumn['column' . $idColumn]['oldNameColumn'] = $dataColumn;
                } elseif (strpos($keyColumn, 'fieldsType') !== false) {
                    $arrayTypeAndNameColumn['column' . $idColumn]['fieldsType'] = $dataColumn;
                    $idColumn++;
                }
            }

            foreach ($arrayTypeAndNameColumn as $keyColumn => $dataColumn) {
                $sqlRenameColumns = "ALTER TABLE " . $_POST['nameTable'] . " CHANGE " . $dataColumn['oldNameColumn'] . " " . $dataColumn['nameColumn'] . " " . $dataColumn['fieldsType'];
                $objDataBase->execute($sqlRenameColumns);
            }
            header('Location:index.php?table=' . $_POST['nameTable']);
        }
    }
}
