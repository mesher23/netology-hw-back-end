<?php

class CartClass
{
    static public $allPrice = 0;
    public function __construct($id, $vol)
    {
        $sessionNumber = $_SESSION['cartNumber'];
        $sessionNumber++;
        $_SESSION['cartNumber'] = $sessionNumber;
        $directoryJSON = realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'../json/');
        $directoryArr = scandir($directoryJSON);
        for ($i=2; $i<10; $i++) {
            $dataProductJSON = file_get_contents($directoryJSON . DIRECTORY_SEPARATOR . $directoryArr[$i]);
            $dataProduct = json_decode($dataProductJSON, true);
            foreach ($dataProduct as $key => $data) {
                if ($data['id'] == $id) {
                    $_SESSION['cart' . $_SESSION['cartNumber']]['brand'] = $key;
                    $_SESSION['cart' . $_SESSION['cartNumber']]['id'] = (int)$data['id'];
                    $_SESSION['cart' . $_SESSION['cartNumber']]['price'] = (int)$data['price'];
                    $_SESSION['cart' . $_SESSION['cartNumber']]['vol'] = (int)$vol;
                    self::$allPrice = self::$allPrice + ((int)$data['price'] * (int)$vol);
                    break 2;
                }
            }
        }
        var_dump(self::$allPrice);
    }
}