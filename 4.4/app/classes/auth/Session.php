<?php
/**
 * Файл с классом работающий с сессией
 */

namespace classes\auth;

class Session
{
    /**
     * Session constructor.
     *
     * Стартует сессию и определяет какой файл нужно загрузить
     */
    public function __construct()
    {
        if (empty($_SESSION['on'])) {
            session_start();
            $_SESSION['on'] = 1;
        }
        $this->logout();
        $this->login();
        if (!empty($_SESSION['logUser'])) {
            require_once __DIR__ . '/index.php';
        } else {
            require_once realpath(__DIR__ . '/../../sql_clien/sql_client.php');
        }
    }

    /**
     * Загружает файл который запрашивет поьзователь, если такого нет выдаёт 404 ошибку
     */
    private function login()
    {
        if (isset($_GET['login'])) {
            if (file_exists(__DIR__ . '/' . $_GET['login'] . '.php')) {
                require_once __DIR__ . '/' . $_GET['login'] . '.php';
                die;
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }
    }

    /**
     * Уничтожает сессию
     */
    private function logout()
    {
        if (isset($_POST['logout'])) {
            session_destroy();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }
}