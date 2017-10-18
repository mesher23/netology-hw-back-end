<?php

abstract class ProductClass
{
    abstract function getDataProduct($way);

    abstract function printProduct();
}

trait GetDataProduct
{
    private $price;
    private $sale;
    private $delivery;
    private $brand;

    public static function getDataProduct($way)
    {
        $db = './class/json/' . $way;
        $dbJson = file_get_contents($db);
        $data = json_decode($dbJson, true);
        return $data;
    }
}