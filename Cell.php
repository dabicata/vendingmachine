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
    private $product; // contains the product object
    /*    private $quantity;*/
    private $size; // size of cell
    private $combined = false; // if true cell is merged with other cell

    /**
     * Cell constructor.
     * @param
     * $size
     * sets size of cells
     */
    public function __construct($size)
    {
        $this->size = $size;

    }

    /**
     * @return
     * mixed
     *  returns product object
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param
     * $product
     * sets product object
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /*    public function getQuantity()
        {
            return $this->quantity;
        }
    
        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
        }*/

    /**
     * @return
     * returns size of cell
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param
     * $size
     * sets size of cell
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return
     * bool
     * returns true or false depending if the cell is merged with other
     */
    public function getCombined()
    {
        return $this->combined;
    }

    /**
     * @param
     * $combined
     * set cell as merged
     */
    public function setCombined($combined)
    {
        $this->combined = $combined;
    }

}