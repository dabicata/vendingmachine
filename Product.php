<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/27/17
 * Time: 12:02 PM
 */

namespace vending;


abstract class Product
{
    private $productName; // name of product
    private $size; // size of product
    private $expireDate; // expire date of product

    /**
     * Product constructor.
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

    abstract public function setPrice($price);

    abstract public function getPrice();



    /**
     * returns product name.
     * @return
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
     * @return
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
     * @return
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