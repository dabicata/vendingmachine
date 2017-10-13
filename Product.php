<?php

namespace vending;

/**
 * Class Product
 * Contains productName, size, and expireDate of the product.
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
     * Sets productName, quantity, size and expireDate.
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
     * Sets price of  product.
     * @param $price
     * @return mixed
     */
    abstract public function setPrice($price);

    /** Returns price of product.
     * @return mixed
     */
    abstract public function getPrice();


    /**
     * Returns product name.
     * @return product name
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Sets product name.
     * @param $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }


    /**
     * Returns size of product.
     * @return sets
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets size of product.
     * @param
     * $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


    /**
     * Returns expire date of product.
     * @return set
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Sets expire date of product.
     * @param $expireDate
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    }


}