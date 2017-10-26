<?php

namespace classes\clothing;

use classes\AllProduct;

class Clothing extends AllProduct
{
    use \classes\AllProductTrait;

    public function __construct()
    {
        $dbProduct = self::dataBaseConnect();
        foreach ($dbProduct as $key => $data) {
            if ($data["class"] === "Одежда") {
                $arrayFurniture[$key] = $data;
            }
        }
        $this->dataProduct = $arrayFurniture;
    }
}