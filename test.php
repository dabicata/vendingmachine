<?php

class Mapper
{
    private $map;
    private $rownumber = 3;
    private $columnnumber = 3;

    public function __construct($obj)
    {

        $rowsCount = 4;
        $colsCount = 3;
        $this->map = [];
        $counter = 0;
        for ($y = 0; $y < $rowsCount; $y++) {
            for ($x = 0; $x < $colsCount; $x++) {
                if (isset($obj[$counter])) {
                    $this->map[$y][] = $obj[$counter++];
                } else {
                    break;
                }

            }
        }
//        var_dump($this->map);
    }




}

class Cell
{
    public $text;
    private $size = 10;
    private $combined = false;

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function ads($quantity)
    {
        $this->quantity = $quantity;
    }

    public function __construct($msg)
    {
        $this->text = $msg;

    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text2)
    {
        $this->text = $text2;
    }

    public function setCombined($combined)
    {
        $this->combined = $combined;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }
}

class Product
{
    private $productname;
    private $quantity;
    private $size;
    private $expiredate;

    public function __construct($productname, $quantity, $size, $expiredate)
    {
        $this->productname = $productname;
        $this->quantity = $quantity;
        $this->size = $size;
        $this->expiredate = $expiredate;
    }


    public function getProductName()
    {
        return $this->productname;
    }

    public function setProductName($productname)
    {
        $this->productname = $productname;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getExpireDate()
    {
        return $this->expiredate;
    }

    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;
    }


}

$a = new Cell('hello');
$a1 = new Cell('hello from a1');
$a2 = new Cell('hello from a2');
$a3 = new Cell('hello from a3');
$a4 = new Cell('hello from a4');
$a5 = new Cell('hello from a5');
$a6 = new Cell('hello from a6');
$a7 = new Cell('hello from a7');
$a8 = new Cell('hello from a8');
$a9 = new Cell('hello from a9');
$a10 = new Cell('hello from a10');
$a11 = new Cell('hello from a11');
$a12 = new Cell('hello from a12');
$a13 = new Cell('hello from a13');
$a14 = new Cell('hello from a14');
$a15 = new Cell('hello from a15');
$products1 = new Product('pizza1', '15', '3', 2018);
$products2 = new Product('pizza2', '10', '4', 2018);
$products3 = new Product('pizza3', '10', '13', 2018);
$products4 = new Product('pizza4', '10', '1', 2018);
$products5 = new Product('pizza5', '10', '1', 2018);
$products6 = new Product('pizza6', '10', '1', 2018);
$products7 = new Product('pizza7', '10', '1', 2018);
$products8 = new Product('pizza8', '10', '1', 2018);
$products9 = new Product('pizza9', '10', '1', 2018);
$products10 = new Product('pizza10', '10', '1', 2018);
$products11 = new Product('pizza11', '10', '1', 2018);
$products12 = new Product('pizza12', '10', '1', 2018);
$b = new Mapper (array($a, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15));
$b->loadProduct(array($products1, $products2, $products3, $products4, $products5, $products6, $products7, $products8, $products9, $products10, $products11, $products12));
