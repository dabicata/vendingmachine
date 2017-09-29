<?php

namespace vending;
class VendingMachine
{
    private $rownumber; //row numbers
    private $columnnumber; //column numbers
    private $maxcells;  //maximum cells
    private $cellsize;  //cell size
    private $map;   //mapped cells to machine


    /**
     * VendingMachine constructor.
     *
     * @param $rownumber
     * @param $columnnumber
     * @param $cellsize
     * sets rows columns and cell size of machine
     */
    public function __construct($rownumber, $columnnumber, $cellsize)
    {
        $this->columnnumber = $columnnumber;
        $this->rownumber = $rownumber;
        $this->maxcells = $rownumber * $columnnumber;
        $this->cellsize = $cellsize;

    }

    /**
     * @param $obj
     * create new cell and map it to machine
     */
    public function createCell($obj)
    {

        $this->map = [];
        $counter = 0;
        for ($y = 0; $y < $this->rownumber; $y++) {
            for ($x = 0; $x < $this->columnnumber; $x++) {
                if (isset($obj[$counter])) {
                    $this->map[$y][$x] = $obj[$counter++];
//                    $this->map[$y][$x] = new Cell($this->cellsize);
                } else {
                    break;
                }

            }
        }


//        var_dump($this->map);
    }

    /**
     *
     *
     * @return mixed
     * returns row number of machine
     */
    public function getRow()
    {
        return $this->rownumber;
    }

    /**
     * @return mixed
     * return column number of machine
     */
    public function getColumn()
    {
        return $this->columnnumber;
    }


    /**
     * @return mixed
     * returns cell size of machine
     */
    public function getCellsize()
    {
        return $this->cellsize;
    }


    /**
     * @param $x rows of the first cell you want to combine
     * @param $y column of first the cell you want to combine
     * @param $a rows of the second cell you want to combine
     * @param $b column of second the cell you want to combine
     *  merge 2 cells into one from left to right
     * example cell with cordinates 1,1 merged with 2,2
     */
    public function combineCells($x, $y, $a, $b)
    {
        if ($x == $a && $b == $y + 1) {
            if ($this->map[$x][$y] && $this->map[$x][$y]) {
                $this->map[$x][$y]->setSize($this->map[$x][$y]->getSize() * 2);
                $this->map[$x][$y]->setCombined(true);
                $this->map[$a][$b]->setCombined(true);
                $this->map[$a][$b]->setSize(0);
            } else {
                echo "cell doesn't exist \n";
            }
        } else {
            echo "error you can combine only cells on same row from left to right \n";
        }


    }

    /**
     * @param $obj2 array of objects of products
     * loads product objects into cells
     */
    public function loadProduct($obj2)
    {


        $counter2 = 0;
        for ($y = 0; $y < $this->rownumber; $y++) {
            for ($x = 0; $x < $this->columnnumber; $x++) {
                if (isset($obj2[$counter2]) && $this->map[$y][$x]->getSize() >= $obj2[$counter2]->getSize()) {
                    $this->map[$y][$x]->setProduct($obj2[$counter2]);
                    /* $hey = (($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                                         $this->map[$y][$x]->getProduct()->setQuantity((int)($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                                        ($obj2[$counter2]->getQuantity() - (($obj2[$counter2]->getQuantity() / $this->map[$y][$x]->getSize()))) > $obj2[$counter2]->getQuantity())*/
                    if (($obj2[$counter2]->getQuantity() * $obj2[$counter2]->getSize()) > $this->map[$y][$x]->getSize()) {
                        $quantity = $obj2[$counter2]->getQuantity();
                        $this->map[$y][$x]->getProduct()->setQuantity((int)($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                        echo ($quantity - $this->map[$y][$x]->getProduct()->getQuantity()) . " " . $this->map[$y][$x]->getProduct()->getProductName() . "s " . "not loaded. \n";
                    }
                    //var_dump($this->map[$y][$x]->getProduct());

                    $counter2++;
                } else {
                    $counter2++;
                    echo "Product can't be loaded, product is too big. \n";
                }
            }
        }


    }

    /**
     * @param
     * $x row of the cell containing the product
     * @param
     * $y column of the cell containing the product
     * @return  product name
     * returns product of cell
     */
    public function buyProduct($x, $y)
    {
        $this->map[$x][$y]->getProduct()->setQuantity($this->map[$x][$y]->getProduct()->getQuantity() - 1);
        /*var_dump($this->map[$x][$y]->getProduct()->getQuantity()-1);
        var_dump($this->map[$x][$y]);*/
        echo $this->map[$x][$y]->getProduct()->getProductName();
    }

    /**
     * @return
     * name of product
     * displays all products from machine
     */
    public function listItems()
    {
        for ($y = 0; $y < $this->rownumber; $y++) {
            for ($x = 0; $x < $this->columnnumber; $x++) {
                if (!$this->map[$y][$x]->getCombined() && $this->map[$y][$x]->getSize() == 0) ;
                if (!null == $this->map[$y][$x]->getProduct()) {
                    echo $this->map[$y][$x]->getProduct()->getProductName() . "\n";
                    echo $this->map[$y][$x]->getProduct()->getQuantity() . "\n";
                }
            }
        }

    }
}
