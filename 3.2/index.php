<?php

abstract class ParentAbstractClass
{
    abstract function __construct();

    abstract function printObj();
}

interface CarInterface
{
    public function carPrint();
}

class Car extends ParentAbstractClass implements CarInterface
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

    public function printObj()
    {
        echo "Класс машин";
    }

    public function carPrint()
    {
        echo $this->brand . ' ' . $this->power . ' ' . $this->fuel;
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

interface TVInterface
{
    public function TVPrint();
}

class TV extends ParentAbstractClass implements TVInterface
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

    public function printObj()
    {
        echo "Класс ТВ";
    }

    public function TVPrint()
    {
        echo $this->color . ' ' . $this->screenResolution . ' ' . $this->price . ' ' . $this->equipment . ' ' . $this->guarantee;
    }
}

interface BallPenBoxInterface
{
    public function BallPenBoxPrint();
}

class BallPenBox extends ParentAbstractClass implements BallPenBoxInterface
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

    public function printObj()
    {
        echo "Класс коробки с ручками";
    }

    public function BallPenBoxPrint()
    {
        echo $this->color . ' ' . $this->price . ' ' . $this->quantityInTheBox;
    }
}

interface DuckInterface
{
    public function DuckPrint();
}

class Duck extends ParentAbstractClass implements DuckInterface
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

    public function printObj()
    {
        echo "Класс с утками";
    }

    public function DuckPrint()
    {
        echo $this->weight . ' ' . $this->name . ' ' . $this->status;
    }
}

interface ProductInterface
{
    public function printProduct();
}

class Product extends ParentAbstractClass implements ProductInterface
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

    public function printObj()
    {
        echo "Класс с продуктами";
    }
}

$car = new Car('Красный', '80 л.с.', '7л на 100км', 'Лада');
$car1 = new Car();

$televisor = new TV('Белый', '4K', 30000);
$televisor1 = new TV();

$ballPenBox = new BallPenBox('Красный', 500, 100);
$ballPenBox1 = new BallPenBox('Чёрный');

$duck = new Duck('Весомый', 'Скрудж Макдак', 'Селезень-миллиардер');
$duck1 = new Duck('Супергеройский', 'Чёрный Плащ', 'Ужас, летящий на крыльях ночи');

$product = new Product(15000, 'Фрезерный станок с ЧПУ', 'На складе');
$product1 = new Product(9000, 'Фрезерный станок', 'На складе');

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

$car->carPrint();
echo '<br>';
echo '<br>';
$product->printProduct();
echo '<br>';
