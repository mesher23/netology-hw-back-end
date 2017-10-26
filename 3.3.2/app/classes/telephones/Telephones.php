<?php

namespace classes\telephones;

use classes\AllProduct;

class Telephones extends AllProduct
{
    use \classes\AllProductTrait;

    public function __construct()
    {
        $dbProduct = self::dataBaseConnect();
        foreach ($dbProduct as $key => $data) {
            if ($data["class"] === "Телефон") {
                $arrayTelephones[$key] = $data;
            }
        }
        $this->dataProduct = $arrayTelephones;
    }
}