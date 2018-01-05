<?php

namespace vending\controller;


use vending\model\DAO\CellDAO;
use vending\model\VendingMachine;

class VendingMachineController
{
    public function createMachine($rowNumber, $columnNumber, $cellSize, $machineName, $machineDesc, $machineStatus, $machineActiveDays)
    {
        $vendingMachine = new VendingMachine();
        $machineDao = new MachineDAO();
        $activeDaysDB = new ActiveDaysDAO();
        $machineId = $machineDao->insert(array($rowNumber, $columnNumber, $cellSize, $machineName, $machineDesc, $machineStatus));
        $vendingMachine->setMachineId($machineId);
        $vendingMachine->setColumnNumber($columnNumber);
        $vendingMachine->setRowNumber($rowNumber);
        $vendingMachine->setCellSize($cellSize);
        $vendingMachine->setMachineName($machineName);
        $vendingMachine->setMachineDesc($machineDesc);
        $vendingMachine->setMachineStatus($machineStatus);
        $vendingMachine->setMachineActiveDays($machineActiveDays);
        foreach ($machineActiveDays as $dayId) {
            $activeDaysDB->insert([$vendingMachine->getMachineId(), $dayId]);
        }
        $this->defineMachine($vendingMachine);
    }

    /**
     * Create new cell and cellMatrix it to machine.
     *
     * @param $vendingMachine
     */
    public function defineMachine($vendingMachine)
    {
        $cellDAO = new CellDAO();
        $vendingMachine->setCellMatrix([]);
        for ($row = 0; $row < $vendingMachine->getRowNumber(); $row++) {
            for ($column = 0; $column < $vendingMachine->getColumnNumber(); $column++) {
                $cellId = $cellDAO->insert([$vendingMachine->getMachineId(), $row, $column]);
                $cellMatrix[$row][$column] = new Cell($this->cellSize, $cellId);
            }
        }
        $vendingMachine->setCellMatrix($cellMatrix);
    }

    /**
     * Loads machine data from the Mysql Database.
     *
     * @param $machineId
     */
    public function loadMachine($machineId)
    {
        $vendingMachine = new VendingMachine();
        $machineDao = new MachineDAO();
        $machineData = $machineDao->select([$machineId]);
        if (($machineData) != null) {
            $vendingMachine->setMachineId($machineData['vendingMachineId']);
            $vendingMachine->setRowNumber($machineData['vendingMachineRows']);
            $vendingMachine->setColumnNumber($machineData['vendingMachineColumns']);
            $vendingMachine->setCellSize($machineData['vendingMachineSize']);
            $cellDAO = new CellDAO();
            $productData = new ProductsDAO();
            $cellDB = $cellDAO->selectCellByMachineId([$machineId]);
            if (($cellDB) != null) {
                $cellMatrix = [];
                $counter = 0;
                for ($row = 0; $row < $vendingMachine->getRowNumber(); $row++) {
                    for ($column = 0; $column < $vendingMachine->getColumnNumber(); $column++) {
                        $cellMatrix[$cellDB[$counter]['cellRow']][$cellDB[$counter]['cellColumn']] = new Cell($vendingMachine->getCellSize(), $cellDB[$counter]['cellId']);
                        $counter++;
                        $productDB = $productData->selectProductByCellId([$vendingMachine->getCell($row, $column)->getCellId()]);
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
                                $cellMatrix[$row][$column]->setProduct($productOBJ);
                            }
                        }
                    }
                }
                $vendingMachine->setCellMatrix($cellMatrix);
            }
        }
    }

    /**
     * Loads product objects into cells.
     *
     * @param array|iterable $productArray array of objects of products
     * @return array
     */
    public function loadProducts(iterable $productArray, $vendingMachine)
    {
        $vendingMachine = new VendingMachine();
        $productDAO = new ProductsDAO();
        foreach ($productArray as $key => $product) {
            foreach ($vendingMachine->getCellMatrix() as $matrix) {
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
    public function deleteMachine($vendingMachine)
    {
        $vendingMachine = new VendingMachine();
        $productDAO = new ProductsDAO();
        $cellDAO = new CellDAO();
        $machineDAO = new MachineDAO();
        if ($vendingMachine->getCellMatrix() !== null) {
            foreach ($vendingMachine->getCellMatrix() as $cells) {
                foreach ($cells as $cell) {
                    $cellIdArray[] = $cell->getCellId();
                }
            }
            $productDAO->deleteByCellId($cellIdArray);
        }
        $cellDAO->deleteByMachineId([$vendingMachine->getMachineId()]);
        if ($vendingMachine->getMachineId() !== null) {
            $machineDAO->delete([$vendingMachine->getMachineId()]);
        }
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
    public function combineCells($firstCellRow, $firstCellColumn, $secondCellRow, $secondCellColumn, $vendingMachine)
    {
        $vendingMachine = new VendingMachine();

        if (($firstCellRow == $secondCellRow) && ($secondCellColumn == $firstCellColumn + 1)) {
            if (($vendingMachine->getCell($firstCellRow, $firstCellColumn)) && ($vendingMachine->getCell($secondCellRow, $secondCellColumn))) {
                $vendingMachine->getCell($firstCellRow, $firstCellColumn)->setSize($vendingMachine->getCell($firstCellRow, $firstCellColumn)->getSize() * 2);
                $vendingMachine->getCell($secondCellRow, $secondCellColumn)->setSize(0);
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
    public function listItems($vendingMachine)
    {
        $vendingMachine = new VendingMachine();

        if ($vendingMachine->getCellMatrix() !== null) {
            foreach ($vendingMachine->getCellMatrix() as $matrix) {
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
    public function removeExpiredProducts($vendingMachine)
    {
        $vendingMachine = new VendingMachine();

        $productDAO = new ProductsDAO();
        $productDAO->deleteExpired();
        foreach ($vendingMachine->getCellMatrix() as $matrix) {
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