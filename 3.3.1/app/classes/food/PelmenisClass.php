<?php

namespace classes\food;

class PelmenisClass extends \ProductClass
{

    public static $saleIncrement;

    use \GetDataProduct;

    public function __construct($brandName)
    {
        $data = \GetDataProduct::getDataProduct('pelmenis.json');
        if (!array_key_exists($brandName, $data)) {
            $this->brand = 'Эти пельмени съели, либо не правельно введено название!';
        } else {
            $dataThisProduct = $data[$brandName];
            self::$saleIncrement++;
            if (self::$saleIncrement === count($data)) {
                $this->price = $dataThisProduct['price'];
                $this->sale = 'Нет скидки';
            } else {
                $this->price = $dataThisProduct['price'] * 0.9;
                $this->sale = '10%';
            }

            if ($this->price === $dataThisProduct['price'] * 0.9) {
                $this->delivery = 300;
            } else {
                $this->delivery = 250;
            }

            $this->brand = $brandName;
            $this->id = $data[$brandName]['id'];
        }
    }

    public function printProduct()
    {
        echo 'Пельмени: ' . $this->brand . '<br />';
        if ($this->sale === 'Нет скидки') {
            echo 'Цена: ' . $this->price . ' руб.<br />';
        } else {
            echo 'Цена со скидкой: ' . $this->price . ' руб.<br />';
        }
        echo 'Доставка: ' . $this->delivery . ' руб.<br />';
    }
}
