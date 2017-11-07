<?php
/**
 * Файл с классом который подключается к базе данных и отправляет запросы
 * Подсмотрел в интернете =)
 */

class DataBase
{
    private $link;

    /**
     * DataBase constructor.
     *
     * Вызывет метод connect
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Подключается к базе данных
     * Записывает в $link объект PDO
     */
    private function connect()
    {
        $config = require_once 'config.php';
        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbName'].';charset='.$config['charset'];
        $this->link = new PDO($dsn, $config['userName'], $config['userPassword'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    /**
     * Отправляет запрос для записи
     *
     * @param $sql
     * @return mixed
     */
    public function execute($sql, $arrayPlaceholder = [])
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute($arrayPlaceholder);
    }

    /**
     * Отправляет запрос для чтения
     *
     * @param $sql запрос к бд
     * @return $result возвращяет ассоциативный массив, но если запрос не выполнился возвращяет пустой массив
     */
    public function query($sql, $arrayPlaceholder = [])
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($arrayPlaceholder);
        $result = $sth->fetchALL(PDO::FETCH_ASSOC);
        if ($result === false) {
            return [];
        }
        return $result;
    }

}
