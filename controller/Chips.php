<?php

namespace vending;

/**
 * Class Chips
 * Extends product class.
 * Sets properties of extend product class
 * and adds price as property.
 *
 * @package vending
 */
class Chips extends Product
{
    private $price;
    CONST TYPEID = 2;
    CONST SIZE = 2;
    /**
     * Cola constructor.
     * sets productName,size and expire date of product in abstract class
     * and sets price.
     *
     * @param sets $price
     * @param sets $expireDate
     */
    public function __construct($price, $expireDate)
    {
        $productName = (new \ReflectionClass($this))->getShortName();

        $this->price = $price;
        parent::__construct($productName, SELF::SIZE, $expireDate);
    }

    /**
     * Returs price of product.
     *
     * @return sets
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Sets price of product.
     *
     * @param $price
     * @return mixed
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Returns typeId of product.
     *
     * @return int
     */
    public function getTypeId(): int
    {
        return SELF::TYPEID;
    }

}
