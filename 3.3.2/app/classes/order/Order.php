<?php

namespace classes\order;


class Order
{
    use \classes\AllProductTrait;

    public function __construct($arraySession)
    {
        $this->dataProduct = $arraySession;
    }

    public function printOrder()
    {
        $producValueId = array_count_values($this->dataProduct['idProduct']);
        $dbProduct = self::dataBaseConnect();
        foreach ($producValueId as $id => $quantity) {
            echo '<div>';
            echo 'Товар: ' . $dbProduct[$id]['brand'] . '<br />';
            echo 'Цена: ' . ($dbProduct[$id]['price'] * $quantity) . '<br />';
            echo 'Количестов: ' . $quantity . ' шт.<br />';
            echo '<a href="order.php?delId=' . $id . '">Удалить из корзины</a>';
            echo '</div>';
        }
    }
}
