<?php

namespace vending;

/**
 * Class Cell
 * contains objects of product class
 * @package vending
 */
class Cell
{
    private $products; // contains the product object
    private $size; // size of cell

    /**
     * sets size of cells
     * Cell constructor.
     * @param $size
     */
    public function __construct($size)
    {
        $this->size = $size;

    }

    /**
     *  returns product object
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * sets product object
     * @param $product
     */
    public function setProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * returns quantity of products in the cell
     * @return int
     */
    public function getQuantity()
    {
        return count($this->products);
    }


    /**
     * returns size of cell
     * @return
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * sets size of cell
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


    /**
     * returs first product from the products array
     * @return mixed
     */
    public function getProductFromArray()
    {
        return $this->products[0];

    }

    /**
     * pops product from array
     * @return mixed
     */
    public function popProduct()
    {
        array_pop($this->products);
    }

    /**
     * remove product from products array and reformat it
     * @param $x
     */
    public function removeProduct($x)
    {
        unset($this->products[$x]);
        $this->products = array_values($this->products);
    }
}