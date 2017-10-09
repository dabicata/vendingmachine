<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/27/17
 * Time: 12:00 PM
 */

namespace vending;


class Cell
{
    private $products; // contains the product object
//    private $quantity = 0;
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
    public function getProduct()
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

    public function getQuantity()
    {
        return count($this->products);
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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



    public function getProductFromArray()
    {
        return $this->products[0];

    }

    /**
     * @return mixed
     */
    public function popProduct()
    {
        array_pop($this->products);
    }
}