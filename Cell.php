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
        return $this->product;
    }

    /**
     * sets product object
     * @param $product
     */
    public function setProduct(Product $product)
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
     * returns true or false depending if the cell is merged with other
     * @return
     * bool
     */
    public function getCombined()
    {
        return $this->combined;
    }

    /**
     * set cell as merged
     * @param $combined
     */
    public function setCombined($combined)
    {
        $this->combined = $combined;
    }

}