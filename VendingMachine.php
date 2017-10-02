<?php

namespace vending;
class VendingMachine
{
    private $rowNumber; //row numbers
    private $columnNumber; //column numbers
    private $cellSize;  //cell size
    private $cellMatrix;   //cellMatrixped cells to machine


    /**
     * VendingMachine constructor.
     * sets rows columns and cell size of machine
     * @param $rowNumber
     * @param $columnNumber
     * @param $cellSize
     */
    public function __construct($rowNumber, $columnNumber, $cellSize)
    {
        $this->columnNumber = $columnNumber;
        $this->rowNumber = $rowNumber;
        $this->cellSize = $cellSize;

    }

    /**
     * returns row number of machine
     * @return mixed
     */
    public function getRow()
    {
        return $this->rowNumber;
    }

    /**
     * create new cell and cellMatrix it to machine
     * @param $obj
     */
    public function defineMachine()
    {

        $this->cellMatrix = [];
        for ($column = 0; $column < $this->rowNumber; $column++) {
            for ($row = 0; $row < $this->columnNumber; $row++) {
//                    $this->cellMatrix[$column][$row] = $obj[$counter++];
                $this->cellMatrix[$column][$row] = new Cell($this->cellSize);
            }
        }


//        var_dump($this->cellMatrix);
    }

    /**
     * return column number of machine
     * @return mixed
     */
    public function getColumn()
    {
        return $this->columnNumber;
    }


    /**
     * returns cell size of machine
     * @return mixed
     */
    public function getCellsize()
    {
        return $this->cellSize;
    }


    /**
     * merge 2 cells into one from left to right
     * example cell with cordinates 1,1 merged with 2,2@param $row rows of the first cell you want to combine
     * @param $column column of first the cell you want to combine
     * @param $a rows of the second cell you want to combine
     * @param $b column of second the cell you want to combine
     */
    public function combineCells($firstCellRow, $firstCellColumn, $secondCellRow, $secondCellColumn)
    {
        if ($firstCellRow == $secondCellRow && $secondCellColumn == $firstCellColumn + 1) {
            if ($this->cellMatrix[$firstCellRow][$firstCellColumn] && $this->cellMatrix[$secondCellRow][$secondCellColumn]) {
                $this->cellMatrix[$firstCellRow][$firstCellColumn]->setSize($this->cellMatrix[$firstCellRow][$firstCellColumn]->getSize() * 2);
                $this->cellMatrix[$firstCellRow][$firstCellColumn]->setCombined(true);
                $this->cellMatrix[$secondCellRow][$secondCellColumn]->setCombined(true);
                $this->cellMatrix[$secondCellRow][$secondCellColumn]->setSize(0);
            } else {
                echo "cell doesn't exist \n";
            }
        } else {
            echo "error you can combine only cells on same row from left to right \n";
        }


    }

    /**
     * loads product objects into cells
     * @param $productArray array of objects of products
     */
    public function loadProduct(array $productArray)
    {


        $counter = 0;
        for ($column = 0; $column < $this->rowNumber; $column++) {
            for ($row = 0; $row < $this->columnNumber; $row++) {
                if (isset($productArray[$counter]) && $this->cellMatrix[$column][$row]->getSize() >= $productArray[$counter]->getSize()) {
                    $this->cellMatrix[$column][$row]->setProduct($productArray[$counter]);
                    /* $hey = (($this->cellMatrix[$column][$row]->getSize() / ($productArray[$counter]->getSize())));
                                         $this->cellMatrix[$column][$row]->getProduct()->setQuantity((int)($this->cellMatrix[$column][$row]->getSize() / ($productArray[$counter]->getSize())));
                                        ($productArray[$counter]->getQuantity() - (($productArray[$counter]->getQuantity() / $this->cellMatrix[$column][$row]->getSize()))) > $productArray[$counter]->getQuantity())*/
                    if (($productArray[$counter]->getQuantity() * $productArray[$counter]->getSize()) > $this->cellMatrix[$column][$row]->getSize()) {
                        $quantity = $productArray[$counter]->getQuantity();
                        $this->cellMatrix[$column][$row]->getProduct()->setQuantity((int)($this->cellMatrix[$column][$row]->getSize() / ($productArray[$counter]->getSize())));
                        echo ($quantity - $this->cellMatrix[$column][$row]->getProduct()->getQuantity()) . " " . $this->cellMatrix[$column][$row]->getProduct()->getProductName() . "s " . "not loaded. \n";
                    }
                    //var_dump($this->cellMatrix[$column][$row]->getProduct());

                    $counter++;
                } else {
                    $counter++;
                    echo "Product can't be loaded, product is too big. \n";
                }
            }
        }


    }

    /**
     * returns product of cell
     * @param $row row of the cell containing the product
     * @param $column column of the cell containing the product
     * @return  product name
     */
    public function buyProduct($row, $column)
    {
        if ($this->cellMatrix[$row][$column]->getProduct()->getQuantity() > 0) {
            $this->cellMatrix[$row][$column]->getProduct()->setQuantity($this->cellMatrix[$row][$column]->getProduct()->getQuantity() - 1);
            /*var_dump($this->cellMatrix[$row][$column]->getProduct()->getQuantity()-1);
            var_dump($this->cellMatrix[$row][$column]);*/
            echo $this->cellMatrix[$row][$column]->getProduct()->getProductName();
        } else {
            echo "product not found";
        }
    }

    /**
     * displays all products from machine
     * @return
     * name of product
     */
    public function listItems()
    {
        for ($column = 0; $column < $this->rowNumber; $column++) {
            for ($row = 0; $row < $this->columnNumber; $row++) {
                if (!$this->cellMatrix[$column][$row]->getCombined() && $this->cellMatrix[$column][$row]->getSize() == 0) ;
                if (!null == $this->cellMatrix[$column][$row]->getProduct()) {
                    echo $this->cellMatrix[$column][$row]->getProduct()->getProductName() . "\n";
                    echo $this->cellMatrix[$column][$row]->getProduct()->getQuantity() . "\n";
                }
            }
        }

    }
}