<?


abstract class ProductClass
{
    abstract function printProduct();
}

trait GetDataProduct
{
    private $price;
    private $sale;
    private $delivery;
    private $brand;
    private $id;

    public static function getDataProduct($way)
    {
        $db = './app/json/' . $way;
        $dbJson = file_get_contents($db);
        $data = json_decode($dbJson, true);
        return $data;
    }
}