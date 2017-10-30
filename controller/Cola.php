<?php

namespace vending;

/**
 * Class Cola
 * Extends product class.
 * Sets properties of extend product class
 * and adds price as property.
 * @package vending
 */
class Cola extends Product
{
    private $price;
    private $typeId = 1;


    /**
     * Cola constructor.
     * Sets productName,size and expire date of product in abstract class
     * and sets price.
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
     * Returs price of product.
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

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

}
