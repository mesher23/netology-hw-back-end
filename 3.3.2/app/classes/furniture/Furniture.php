<?php

namespace classes\furniture;

use classes\AllProduct;

class Furniture extends AllProduct
{
    use \classes\AllProductTrait;

    public function __construct()
    {
        $dbProduct = self::dataBaseConnect();
        foreach ($dbProduct as $key => $data) {
            if ($data["class"] === "Мебель") {
                $arrayFurniture[$key] = $data;
            }
        }
        $this->dataProduct = $arrayFurniture;
    }
}