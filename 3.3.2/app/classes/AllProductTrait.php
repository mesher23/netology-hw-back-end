<?php

namespace classes;


trait AllProductTrait
{
    public $dataProduct;

    public static function dataBaseConnect()
    {
        $dbJSON = file_get_contents(realpath(__DIR__ . DIRECTORY_SEPARATOR . '../db/db.json'));
        $dbArray = json_decode($dbJSON, true);
        return $dbArray;
    }

    public function printProduct()
    {
        foreach ($this->dataProduct as $key => $data) {
            echo '<p>Товар: ' . $data['brand'] . '</p>';
            echo '<p>Цена: ' . $data['price'] . '</p>';
            echo '<a href="index.php?id=' . ((int)$key) . '">Добавить в корзину</a>';
        }
    }
}