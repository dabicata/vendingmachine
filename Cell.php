<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/27/17
 * Time: 12:00 PM
 */

class Cell
{
    private $product;
    /*    private $quantity;*/
    private $size;
    private $combined = false;

    public function __construct($product, $quantity, $size)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->size = $size;

    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getCombined()
    {
        return $this->combined;
    }

    public function setCombined($combined)
    {
        $this->combined = $combined;
    }

}