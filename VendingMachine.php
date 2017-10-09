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
        for ($row = 0; $row < $this->rowNumber; $row++) {
            for ($column = 0; $column < $this->columnNumber; $column++) {
//                    $this->cellMatrix[$column][$row] = $obj[$counter++];
                $this->cellMatrix[$row][$column] = new Cell($this->cellSize);
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
    /**
     * @param mixed $cellSize
     */
    public function setCellSize($cellSize)
    {
        $this->cellSize = $cellSize;
    }

    public function getCellSize()
    {
        return $this->cellSize;
    }


    /**
     * merge 2 cells into one from left to right
     * example cell with cordinates 1,1 merged with 2,2 @param $row rows of the first cell you want to combine
     * @param $column column of first the cell you want to combine
     * @param $a rows of the second cell you want to combine
     * @param $b column of second the cell you want to combine
     */
    public function combineCells($firstCellRow, $firstCellColumn, $secondCellRow, $secondCellColumn)
    {
        if (($firstCellRow == $secondCellRow) && ($secondCellColumn == $firstCellColumn + 1)) {
            if (($this->cellMatrix[$firstCellRow][$firstCellColumn]) && ($this->cellMatrix[$secondCellRow][$secondCellColumn])) {
                $this->cellMatrix[$firstCellRow][$firstCellColumn]->setSize($this->cellMatrix[$firstCellRow][$firstCellColumn]->getSize() * 2);
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

    public function loadProduct2(iterable $productArray)
    {
        foreach ($productArray as $product) {
            foreach ($this->cellMatrix as $matrix) {
                foreach ($matrix as $cell) {
                    if ($product->getSize() <= $cell->getSize()) {
                        if (is_null($cell->getProduct())) {
                            $cell->setProduct($product);
                            break 2;
                        } else {
                            if (($cell->getProductFromArray()->getProductName()) == ($product->getProductName())) {
                                if (((($cell->getSize() - ($product->getSize())) * (count($cell->getProduct()))) / $product->getSize() >= 1)) {
                                    $cell->setProduct($product);
                                    break 2;
                                } else {
                                    $returnProducts[] = $product;
                                    echo $product->getProductName() . " can't be loaded \n";
                                    break 2; /*break 2 makes it puts different items in each cell; no break puts same items in many cells*/
                                }
                            }
                        }
                    }

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
    public
    function buyProduct($row, $column, $price)
    {
        if (count($this->cellMatrix[$row][$column]->getProduct()) > 0) {
            if ($price >= ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice())) {
                $this->cellMatrix[$row][$column]->popProduct();
                echo $this->cellMatrix[$row][$column]->getProductFromArray()->getProductName() . " product bought \n";
                echo 'change ' . ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice()));
            } else {
                echo " not enough money";
            }
        } else {
            echo "product not found";
        }
    }

    /**
     * displays all products from machine
     * @return
     * name of product and quantity
     */
    public
    function listItems()
    {

        foreach ($this->cellMatrix as $matrix) {
            foreach ($matrix as $cell) {

                if (null !== $cell->getProductFromArray()) {

                    echo $cell->getProductFromArray()->getProductName() . "\n";
                    echo (count($cell->getProduct())) . "\n";
                }
            }
        }
    }

    public
    function removeExpireDate()
    {
        foreach ($this->cellMatrix as $matrix) {
            foreach ($matrix as $cell) {
                if ($cell->getProduct() == !null) {
                    foreach ($cell->getProduct() as $products) {
                        if ($products->getExpireDate() >= date("d.m.y")) {
                            $cell->setQuantity($cell->getQuantity() - 1);

                        }

                    }
                }
            }
        }
    }

}



