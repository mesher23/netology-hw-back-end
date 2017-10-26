<?php

function loadFromApp($aClassName)
{
    $aClassNameArr = explode('\\', $aClassName);
    if (file_exists(__DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $aClassNameArr) . '.php')) {
        include_once __DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $aClassNameArr) . '.php';
    }
}

spl_autoload_register('loadFromApp');