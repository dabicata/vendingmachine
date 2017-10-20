<?php

namespace vending;

/**
 * Class Snikers
 * Extends product class.
 * Sets properties of extend product class
 * and adds price as property.
 * @package vending
 */
class Snikers extends Product
{
    private $price;

    /**
     * Cola constructor.
     * Sets productname,size and expire date of product in abstract class
     * and sets price.
     * @param sets $price
     * @param sets $expireDate
     */
    public function __construct($price, $expireDate)
    {
        $productName = (new \ReflectionClass($this))->getShortName();
        $size = 1;
        $this->price = $price;
        parent::__construct($productName, $size, $expireDate);
    }

    /**
     * Returns price of product.
     * @return sets
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Sets price of product.
     * @param $price
     * @return mixed
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}
