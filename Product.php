<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/27/17
 * Time: 12:02 PM
 */

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

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


}