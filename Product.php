<?php

namespace vending;

/**
 * Class Product
 * contains productName, size, and expireDate of the product
 * @package vending
 */
abstract class Product
{
    private $productName; // name of product
    private $size; // size of product
    private $expireDate; // expire date of product

    /**
     * Product constructor.
     *
     * sets productName, quantity, size and expireDate.
     * @param $productName sets productName
     * @param $size sets size of product
     * @param $expireDate set expire date of product
     */
    public function __construct($productName, $size, $expireDate)
    {
        $this->productName = $productName;
        $this->size = $size;
        $this->expireDate = $expireDate;
    }

    /**
     * sets price of  product
     * @param $price
     * @return mixed
     */
    abstract public function setPrice($price);

    /** returns price of product
     * @return mixed
     */
    abstract public function getPrice();


    /**
     * returns product name.
     * @return product name
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * sets product name
     * @param $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }


    /**
     * returns size of product
     * @return sets
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * sets size of product
     * @param
     * $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


    /**
     * returns expire date of product
     * @return set
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * sets expire date of product
     * @param $expireDate
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    }


}