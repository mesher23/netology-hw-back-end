<?php
/**
 * Автозагрузчик классов
 */

function loadFromApp($aClassName)
{
    $aClassNameArr = explode('\\', $aClassName);
    if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $aClassNameArr) . '.php')) {
        require_once __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $aClassNameArr) . '.php';
    }
}

spl_autoload_register('loadFromApp');