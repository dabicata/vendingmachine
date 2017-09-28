<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/27/17
 * Time: 12:02 PM
 */

namespace vending;


class Product
{
    private $productname; // name of product
    private $quantity; // quantity of product
    private $size; // size of product
    private $expiredate; // expire date of product

    /**
     * Product constructor.
     * @param $productname sets productname
     * @param $quantity sets quantity of product
     * @param $size sets size of product
     * @param $expiredate set expire date of product
     */
    public function __construct($productname, $quantity, $size, $expiredate)
    {
        $this->productname = $productname;
        $this->quantity = $quantity;
        $this->size = $size;
        $this->expiredate = $expiredate;
    }


    /**
     * @return
     * product name
     */
    public function getProductName()
    {
        return $this->productname;
    }

    /**
     * @param
     * $productname sets product name
     */
    public function setProductName($productname)
    {
        $this->productname = $productname;
    }

    /**
     * @return
     * returns quantity of product
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return
     * returns product size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param
     * $size sets size of product
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return
     * returns expire date of product
     */
    public function getExpireDate()
    {
        return $this->expiredate;
    }

    /**
     * @param
     * $expiredate sets expire date of product
     */
    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}