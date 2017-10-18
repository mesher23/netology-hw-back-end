<?php
require_once 'product.php';

class SugarClass extends ProductClass
{
    public static $saleIncrement;

    use GetDataProduct;

    public function __construct($brandName, $weight)
    {
        $data = GetDataProduct::getDataProduct('sugar.json');
        if (!array_key_exists($brandName, $data)) {
            $this->brand = 'Такого сахара нет!';
        } else {
            $dataThisProduct = $data[$brandName];
            self::$saleIncrement++;
            if ($weight <= 10) {
                $this->price = $dataThisProduct['price'] * $weight;
                $this->sale = 'Нет скидки';
            } else {
                $this->price = $dataThisProduct['price'] * 0.9 * $weight;
                $this->sale = '10%';
            }

            if ($this->price === $dataThisProduct['price'] * 0.9 * $weight) {
                $this->delivery = 300;
            } else {
                $this->delivery = 250;
            }

            $this->brand = $brandName;
        }
    }

    public function printProduct()
    {
        echo 'Вид сахара: ' . $this->brand . '<br />';
        if ($this->sale === 'Нет скидки') {
            echo 'Цена: ' . $this->price . ' руб.<br />';
        } else {
            echo 'Цена со скидкой: ' . $this->price . ' руб.<br />';
        }
        echo 'Доставка: ' . $this->delivery . ' руб.<br />';
    }
}