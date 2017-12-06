<?php

namespace vending\model;


use vending\model\DAO\CellDAO;
use vending\model\DAO\MachineDAO;
use vending\model\DAO\ProductsDAO;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/CellDAO.php';
include_once __DIR__ . '/../model/DAO/ProductsDAO.php';
include_once __DIR__ . '/Cell.php';
include_once __DIR__ . '/Product.php';

/**
 * Class VendingMachine.
 * Create cell objects and map them to the machine, allows you to buy products and check their expiredate.
 *
 * @package vending
 */
class VendingMachine
{
    private $rowNumber; //Row numbers.
    private $columnNumber; //Column numbers.
    private $cellSize; //Cell size.
    private $cellMatrix; //Cell Matrix cells to machine.
    private $machineId; //Id of machine.


    /**
     * Sets rows columns and cell size of machine.
     *
     * @param $rowNumber - rows of machine
     * @param $columnNumber - columns of machine
     * @param $cellSize - default cell size of machine
     */
    public function createMachine($rowNumber, $columnNumber, $cellSize)
    {
        $machineDao = new MachineDAO();
        $this->machineId = $machineDao->insert(array($rowNumber, $columnNumber, $cellSize));
        $this->columnNumber = $columnNumber;
        $this->rowNumber = $rowNumber;
        $this->cellSize = $cellSize;
        $this->defineMachine();
    }

    /**
     * Loads machine data from the Mysql Database.
     *
     * @param $machineId
     */
    public function loadMachine($machineId)
    {
        $machineDao = new MachineDAO();
        $machineData = $machineDao->select([$machineId]);
        if (($machineData) != null) {
            $this->machineId = $machineData['vendingMachineId'];
            $this->rowNumber = $machineData['vendingMachineRows'];
            $this->columnNumber = $machineData['vendingMachineColumns'];
            $this->cellSize = $machineData['machineSize'];
            $cellDAO = new CellDAO();
            $productData = new ProductsDAO();
            $cellDB = $cellDAO->selectCellByMachineId([$machineId]);
            if (($cellDB) != null) {
                $this->cellMatrix = [];
                $counter = 0;
                for ($row = 0; $row < $this->rowNumber; $row++) {
                    for ($column = 0; $column < $this->columnNumber; $column++) {
                        $this->cellMatrix[$cellDB[$counter]['cellRow']][$cellDB[$counter]['cellColumn']] = new Cell($this->cellSize, $cellDB[$counter]['cellId']);
                        $counter++;
                        $productDB = $productData->selectProductByCellId([$this->cellMatrix[$row][$column]->getCellId()]);
                        if ($productDB != null) {
                            foreach ($productDB as $product) {
                                switch ($product['productTypeId']) {
                                    case Cola::TYPEID:
                                        $productOBJ = new Cola($product['productPrice'], $product['productExpireDate']);
                                        break;
                                    case Chips::TYPEID:
                                        $productOBJ = new Chips($product['productPrice'], $product['productExpireDate']);
                                        break;
                                    case Snikers::TYPEID:
                                        $productOBJ = new Snikers($product['productPrice'], $product['productExpireDate']);
                                        break;
                                }
                                $productOBJ->setProductId($product['productId']);
                                $this->cellMatrix[$row][$column]->setProduct($productOBJ);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Create new cell and cellMatrix it to machine.
     */
    public function defineMachine()
    {
        $cellDAO = new CellDAO();
        $this->cellMatrix = [];
        for ($row = 0; $row < $this->rowNumber; $row++) {
            for ($column = 0; $column < $this->columnNumber; $column++) {
                $cellId = $cellDAO->insert([$this->machineId, $row, $column]);
                $this->cellMatrix[$row][$column] = new Cell($this->cellSize, $cellId);
            }
        }
    }

    /**
     * Loads product objects into cells.
     *
     * @param array|iterable $productArray array of objects of products
     * @return array
     */
    public function loadProducts(iterable $productArray)
    {

        $productDAO = new ProductsDAO();
        foreach ($productArray as $key => $product) {
            foreach ($this->cellMatrix as $matrix) {
                foreach ($matrix as $cell) {
                    if ($product->getSize() <= $cell->getSize()) {
                        if ((is_null($cell->getProducts())) ||
                            ($cell->getProductFromArray() != null &&
                                (($cell->getProductFromArray()->getProductName()) == ($product->getProductName())
                                    && (($cell->getSize() / $product->getSize()) > $cell->getQuantity())))
                        ) {
                            $cell->setProduct($product);
                            $productId = $productDAO->insert([
                                $product->getTypeId(),
                                $product->getPrice(),
                                $product->getExpireDate()->format('Y/m/d h:m:s'),
                                $product->getSize(),
                                $cell->getCellId()
                            ]);
                            $product->setProductId($productId);
                            unset($productArray[$key]);
                            break 2;
                        }
                    }
                }
            }
        }
        if ($productArray == !null) {
            return $productArray;
        }
    }

    /**
     *Delete Machine and everything in it.
     */
    public function deleteMachine()
    {
        $productDAO = new ProductsDAO();
        $cellDAO = new CellDAO();
        $machineDAO = new MachineDAO();
        if ($this->cellMatrix !== null) {
            foreach ($this->cellMatrix as $cells) {
                foreach ($cells as $cell) {
                    $cellIdArray[] = $cell->getCellId();
                }
            }
            $productDAO->deleteByCellId($cellIdArray);
        }
        $cellDAO->deleteByMachineId([$this->machineId]);
        if ($this->machineId !== null) {
            $machineDAO->delete([$this->machineId]);
        }
    }

    /**
     * Returns row number of machine.
     *
     * @return mixed
     */
    public function getRow()
    {
        return $this->rowNumber;
    }

    /**
     * Return column number of machine.
     *
     * @return mixed
     */
    public function getColumn()
    {
        return $this->columnNumber;
    }


    /**
     * Sets cell size.
     *
     * @param $cellSize
     */
    public function setCellSize($cellSize)
    {
        $this->cellSize = $cellSize;
    }

    /**
     * Returns cell size.
     *
     * @return mixed
     */
    public function getCellSize()
    {
        return $this->cellSize;
    }

    /**
     * Merge 2 cells into one from left to right.
     * Example: cell with coordinates 1,1 merged with 2,2
     *
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
     *Lets you buy a product.
     *
     * @param $row
     * @param $column
     * @param $price
     * @return string
     * @throws \Exception
     */
    public function buyProduct($row, $column, $price)
    {
        $productDAO = new ProductsDAO();
        if ((count($this->cellMatrix[$row][$column]->getProducts()) > 0)) {
            if ($price >= ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice())) {
                $this->cellMatrix[$row][$column]->removeProduct(0);
                $productDAO->delete([$this->cellMatrix[$row][$column]->getProductFromArray()->getProductId()]);
                return ($price - ($this->cellMatrix[$row][$column]->getProductFromArray()->getPrice()));
            } else {
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
        if ($this->cellMatrix !== null) {
            foreach ($this->cellMatrix as $matrix) {
                foreach ($matrix as $cell) {
                    if (null !== $cell->getProductFromArray()) {
                        echo $cell->getProductFromArray()->getProductName() . ' ' . ($cell->getQuantity()) . "\n";
                    }
                }
            }
        }
    }

    /**
     *Checks if there are expired products and remove them.
     */
    public function removeExpiredProducts()
    {
        $productDAO = new ProductsDAO();
        $productDAO->deleteExpired();
        foreach ($this->cellMatrix as $matrix) {
            $counter = 0;
            foreach ($matrix as $cell) {
                if ($cell->getProducts() !== null) {
                    foreach ($cell->getProducts() as $products) {
                        if ((strtotime($products->getExpireDate())) < strtotime(new \DateTime())) {
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


