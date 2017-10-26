<?php

namespace classes\cart;


class Cart
{
    use \classes\AllProductTrait;

    public function setDataProduct($arraySession)
    {
        $this->dataProduct = $arraySession;
    }

    public function addProduct($id, $vol)
    {
        $_SESSION['cartNumber']++;
        $_SESSION['idProduct'][] = $id;
        $dbProduct = self::dataBaseConnect();
        $_SESSION['cartPrice'] = $_SESSION['cartPrice'] + ($dbProduct[$id]['price'] * $vol);
    }

    public function deleteProduct($id)
    {
        $dbProduct = self::dataBaseConnect();
        $this->dataProduct["cartPrice"] = $this->dataProduct["cartPrice"] - $dbProduct[$id]['price'];
        $this->dataProduct["cartNumber"] = $this->dataProduct["cartNumber"] - 1;
        unset($this->dataProduct['idProduct'][array_search($id, $this->dataProduct['idProduct'])]);
    }
}