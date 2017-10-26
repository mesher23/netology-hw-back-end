<?php

namespace classes\appliances;

use classes\AllProduct;

class Appliances extends AllProduct
{
    use \classes\AllProductTrait;

    public function __construct()
    {
        $dbProduct = self::dataBaseConnect();
        foreach ($dbProduct as $key => $data) {
            if ($data["class"] === "Бытовая техника") {
                $arrayAppliances[$key] = $data;
            }
        }
        $this->dataProduct = $arrayAppliances;
    }
}