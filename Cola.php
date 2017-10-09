<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/9/17
 * Time: 10:29 AM
 */

namespace vending;


class Cola extends Product
{
    private $price;

    public function __construct($price, $expireDate)
    {
        $productName = (new \ReflectionClass($this))->getShortName();
        $size = 2;
        $this->price = $price;
        parent::__construct($productName, $size, $expireDate);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

}
