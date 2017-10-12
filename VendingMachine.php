<?php

namespace vending;

/**
 * Class VendingMachine
 * create cell objects and map them to the machine allows you to buy products and check their expiredate
 * @package vending
 */
class VendingMachine
{
    private $rowNumber; //row numbers
    private $columnNumber; //column numbers
    private $cellSize;  //cell size
    private $cellMatrix;   //cellMatrixped cells to machine


    /**
     * VendingMachine constructor.
     * sets rows columns and cell size of machine
     *
     * @param $rowNumber - rows of machine
     * @param $columnNumber - columns of machine
     * @param $cellSize - default cell size of machine
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
     */
    public function defineMachine()
    {
        $this->cellMatrix = [];
        for ($row = 0; $row < $this->rowNumber; $row++) {
            for ($column = 0; $column < $this->columnNumber; $column++) {
                $this->cellMatrix[$row][$column] = new Cell($this->cellSize);
            }
        }
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
     * sets cell size
     * @param $cellSize
     */
    public function setCellSize($cellSize)
    {
        $this->cellSize = $cellSize;
    }


    /**
     * returns cell size
     * @return mixed
     */
    public function getCellSize()
    {
        return $this->cellSize;
    }

    /**
     * merge 2 cells into one from left to right
     * example cell with cordinates 1,1 merged with 2,2
     * @param $firstCellRow - row of the first cell you want to combine
     * @param $firstCellColumn - column of first the cell you want to combine
     * @param $secondCellRow - row of the second cell you want to combine
     * @param $secondCellColumn - column of second the cell you want to combine
     * @throws \Exception
     */
    public function combineCells($firstCellRow, $firstCellColumn, $secondCellRow, $secondCellColumn)
    {
        if (($firstCellRow == $secondCellRow) && ($secondCellColumn == $firstCellColumn + 1)) {
            if (($this->cellMatrix[$firstCellRow][$firstCellColumn]) && ($this->cellMatrix[$secondCellRow][$secondCellColumn])) {
                $this->cellMatrix[$firstCellRow][$firstCellColumn]->setSize($this->cellMatrix[$firstCellRow][$firstCellColumn]->getSize() * 2);
                $this->cellMatrix[$secondCellRow][$secondCellColumn]->setSize(0);
            } else {
                throw new \Exception("Cell doesn't exist");

            }
        } else {
            throw new \Exception("You can combine only cells on same row from left to right");


        }
    }

    /**
     * loads product objects into cells
     * @param array|iterable $productArray array of objects of products
     */
    public function loadProducts(iterable $productArray)
    {
        $this->removeExpiredProducts();
        foreach ($productArray as $product) {
            foreach ($this->cellMatrix as $matrix) {
                foreach ($matrix as $cell) {

                    if ($product->getSize() <= $cell->getSize()) {
                        if (is_null($cell->getProducts())) {
                            $cell->setProduct($product);
                            break 2;
                        } else {
                            if (($cell->getProductFromArray()->getProductName()) == ($product->getProductName())) {
                                if (((($cell->getSize() - ($product->getSize())) * ($cell->getQuantity())) / $product->getSize() >= 1)) {
                                    $cell->setProduct($product);
                                    break 2;
                                } else {
                                    return $returnProducts[] = $product;
                                    /*                                    echo $product->getProductName() . " can't be loaded \n";*/
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
     * TODO
     *
     * @param $row
     * @param $column
     * @param $price
     * @return string
     * @throws \Exception
     */
    public function buyProduct($row, $column, $price)
    {
        if ((count($this->cellMatrix[$row][$column]->getProducts()) > 0)) {
            if ($price >= ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice())) {
                echo $this->cellMatrix[$row][$column]->getProductFromArray()->getProductName() . " product bought \n";
                echo 'change ' . ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice()));
                return 'change ' . ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice()));
            } else {
                echo 'change ' . ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice())) . "\n";
                return ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice()));

            }
        } else {
            throw new \Exception(" Product not found.");
        }
    }

    /**
     * Displays all products from machine.
     */
    public function listItems()
    {
        foreach ($this->cellMatrix as $matrix) {
            foreach ($matrix as $cell) {
                if (null !== $cell->getProductFromArray()) {
                    echo $cell->getProductFromArray()->getProductName() . "\n";
                    echo ($cell->getQuantity()) . "\n";
                }
            }
        }
    }

    /**
     *checks if there are expired products and remove them
     */
    public function removeExpiredProducts()
    {
        foreach ($this->cellMatrix as $matrix) {
            $counter = 0;
            foreach ($matrix as $cell) {
                if ($cell->getProducts() == !null) {
                    foreach ($cell->getProducts() as $products) {
                        if (($products->getExpireDate()) < new \DateTime(date("d.m.y"))) {
                            $cell->removeProduct($counter);
                        } else {
                            $counter++;
                        }
                    }
                }
            }
        }
    }

}



