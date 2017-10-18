<?php

class CarClass
{
    private $color;
    private $power;
    private $fuel;
    private $brand;
    private $gasTank = 0;

    public function __construct($color = 'Белый', $power = '100 л.с.', $fuel = 10, $brand = 'Форд')
    {
        $this->color = $color;
        $this->power = $power;
        $this->fuel = $fuel;
        $this->brand = $brand;
    }

    public function fueling($liters = 0)
    {
        $this->gasTank = $liters;
        echo 'Машина заправлена на' . $this->gasTank . ' литров';
    }

    public function drive($kilometer = 1)
    {
        if ($this->gasTank = 0) {
            echo 'Бак пуст, надо заправить машину';
        } else {
            $petrolConsumption = $this->gasTank / $this->fuel;
            if ($kilometer > $petrolConsumption) {
                echo 'На такое расстояние не хватает топлива';
            } else {
                echo 'Все отлично, выезжаем';
            }
        }
    }
}

class TVClass
{
    const EQUIPMENT = 'ИК-пульт, Подставка, Кабель питания, HDMI кабель';
    const GUARANTEE = 12;
    private $color;
    private $screenResolution;
    private $price;
    private $сhangeСhannels;

    public function __construct($color = 'Чёрный', $screenResolution = 'Full HD', $price = 15000)
    {
        $this->color = $color;
        $this->screenResolution = $screenResolution;
        $this->price = $price;
    }

    public function TurnOnTheTV()
    {
        $this->сhangeСhannels = isset($this->сhangeСhannels) ? $this->сhangeСhannels : 1;
        echo 'Канал:' . $this->сhangeСhannels;
    }

    public function сhangeСhannel($number)
    {
        $this->сhangeСhannels = $number;
        echo 'Канал:' . $this->сhangeСhannels;
    }

    public function turnOffTheTV()
    {
        $this->сhangeСhannels = null;
    }
}

class BallPenBoxClass
{
    private $color;
    private $price;
    private $quantityInTheBox;

    public function __construct($color = 'Синий', $price = 200, $quantityInTheBox = 50)
    {
        $this->color = $color;
        $this->price = $price;
        $this->quantityInTheBox = $quantityInTheBox;
    }

    public function getThePenOutOfBox($value)
    {
        $this->quantityInTheBox = $this->quantityInTheBox - $value;
        echo 'В коробке осталось: ' . $this->quantityInTheBox . ' ручек';
    }
}

class DuckClass
{
    private $weight;
    private $name;
    private $status;

    public function __construct($weight = 5, $name = 'Утка', $status = 'Крякает')
    {
        $this->weight = $weight;
        $this->name = $name;
        $this->status = $status;
    }

    public function WhatDoesTheDuckDo($status)
    {
        $this->status = $status;
    }

    public function feedTheDucky()
    {
        if ($this->name === 'Скрудж Макдак') {
            echo 'Этот селезень не нуждается в подачках';
        } else {
            $this->status = 'крякает';
            echo 'Утка ' . $this->status;
        }
    }
}

class ProductClass
{
    private $price;
    private $name;
    private $status;
    private $delivery;

    public function __construct($price = 1, $name = 'Товар', $status = 'Нет на скалде')
    {
        if ($price > 10000) {
            $this->delivery = 0;
            $this->price = $price;
        } else {
            $this->delivery = 500;
            $this->price = $price + $this->delivery;
        }
        $this->name = $name;
        $this->status = $status;
    }

    public function send()
    {
        if ($this->delivery === 0) {
            echo 'Товар отправлен';
        } else {
            echo 'Товар отправлен. Стоимость доставки: ' . $this->delivery . ' рублей.';
        }
    }

    public function printProduct()
    {
        if ($this->status === 'Нет на скалде') {
            echo $this->name . ' ' . $this->status;
        } else {
            echo $this->name . '<br>Цена:' . $this->price;
        }
    }
}

$car = new CarClass('Красный', '80 л.с.', 7, 'Лада');
$car1 = new CarClass();

$televisor = new TVClass('Белый', '4K', 30000);
$televisor1 = new TVClass();

$ballPenBox = new BallPenBoxClass('Красный', 500, 100);
$ballPenBox1 = new BallPenBoxClass('Чёрный');

$duck = new DuckClass (10, 'Скрудж Макдак', 'Купается в деньгах');
$duck1 = new DuckClass (7, 'Чёрный Плащ', 'Ловит злодеев');

$product = new ProductClass (15000, 'Фрезерный станок с ЧПУ', 'На складе');
$product1 = new ProductClass (9000, 'Фрезерный станок', 'На складе');

echo '<pre>';
var_dump($car);
var_dump($car1);
var_dump($televisor);
var_dump($televisor1);
var_dump($ballPenBox);
var_dump($ballPenBox1);
var_dump($duck);
var_dump($duck1);
var_dump($product);
var_dump($product1);
echo '</pre>';