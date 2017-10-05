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
    private $productName; // name of product
    /*    private $quantity; // quantity of product*/
    private $size; // size of product
    private $expireDate; // expire date of product

    /**
     * Product constructor.
     * sets productName, quantity, size and expireDate.
     * @param $productName sets productName
     * @param $quantity sets quantity of product
     * @param $size sets size of product
     * @param $expireDate set expire date of product
     */
    public function __construct($productName,/* $quantity,*/
                                $size, $expireDate)
    {
        $this->productName = $productName;
        /*        $this->quantity = $quantity;*/
        $this->size = $size;
        $this->expireDate = $expireDate;
    }


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
     * returns quantity of product
     * @return
     */
    /*    public function getQuantity()
        {
            return $this->quantity;
        }*/

    /*    public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
        }*/

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
    public function setExpiredate($expireDate)
    {
        $this->expireDate = $expireDate;
    }

}