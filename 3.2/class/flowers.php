<?php
require_once 'product.php';

class FlowersClass extends ProductClass
{

    public static $saleIncrement;

    use GetDataProduct;

    public function __construct($brandName, $amount)
    {
        if ($amount == null || !is_int($amount)) {
            $this->brand = 'Не коректно введено количество!';
        } else {
            $data = GetDataProduct::getDataProduct('flowres.json');
            if (!array_key_exists($brandName, $data)) {
                $this->brand = 'Таких цветов нет!';
            } else {
                $dataThisProduct = $data[$brandName];
                self::$saleIncrement++;
                if (self::$saleIncrement === count($data)) {
                    $this->price = $dataThisProduct['price'] * $amount;
                    $this->sale = 'Нет скидки';
                } else {
                    $this->price = $dataThisProduct['price'] * 0.9 * $amount;
                    $this->sale = '10%';
                }

                if ($this->price === $dataThisProduct['price'] * 0.9 * $amount) {
                    $this->delivery = 300;
                } else {
                    $this->delivery = 250;
                }

                $this->brand = $brandName;
            }
        }
    }

    public function printProduct()
    {
        echo 'Цветы: ' . $this->brand . '<br />';
        if ($this->sale === 'Нет скидки') {
            echo 'Цена: ' . $this->price . ' руб.<br />';
        } else {
            echo 'Цена со скидкой: ' . $this->price . ' руб.<br />';
        }
        echo 'Доставка: ' . $this->delivery . ' руб.<br />';
    }
}