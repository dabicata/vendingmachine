<?php

namespace vending;

/**
 * Class Chips
 * extends product class
 * sets properties of extend product class
 * and adds price as property
 * @package vending
 */
class Chips extends Product
{
    private $price;

    /**
     * Cola constructor.
     * sets productname,size and expire date of product in abstract class
     * and sets price
     * @param sets $price
     * @param sets $expireDate
     */
    public function __construct($price, $expireDate)
    {
        $productName = (new \ReflectionClass($this))->getShortName();
        $size = 2;
        $this->price = $price;
        parent::__construct($productName, $size, $expireDate);
    }

    /**
     * returs price of product
     * @return sets
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * sets price of product
     * @param $price
     * @return mixed
     */
    public function setPrice($price)
    {
        return $this->price = $price;
    }

}
