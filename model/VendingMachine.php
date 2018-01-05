<?php

namespace vending\model;


use vending\model\DAO\ActiveDaysDAO;
use vending\model\DAO\CellDAO;
use vending\model\DAO\MachineDAO;
use vending\model\DAO\ProductsDAO;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/ActiveDaysDAO.php';
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
    private $machineName; //Name of machine.
    private $machineDesc; //Description of machine.
    private $machineStatus; //Status of machine.
    private $machineActiveDays; //Active days of machine.


    /**
     * Sets rows columns and cell size of machine.
     *
     * @param $rowNumber - rows of machine
     * @param $columnNumber - columns of machine
     * @param $cellSize - default cell size of machine
     * @param $machineName - name of machine.
     * @param $machineDesc - description of machine.
     * @param $machineStatus - status of machine.
     * @param $machineActiveDays - active days of machine.
     */
    public function createMachine($rowNumber, $columnNumber, $cellSize, $machineName, $machineDesc, $machineStatus, $machineActiveDays)
    {
        $machineDao = new MachineDAO();
        $activeDaysDB = new ActiveDaysDAO();
        $this->machineId = $machineDao->insert(array($rowNumber, $columnNumber, $cellSize, $machineName, $machineDesc, $machineStatus));
        $this->columnNumber = $columnNumber;
        $this->rowNumber = $rowNumber;
        $this->cellSize = $cellSize;
        $this->machineName = $machineName;
        $this->machineDesc = $machineDesc;
        $this->machineStatus = $machineStatus;
        $this->machineActiveDays = $machineActiveDays;
        foreach ($machineActiveDays as $dayId) {
            $activeDaysDB->insert([$this->machineId, $dayId]);
        }
        $this->defineMachine();
    }

    /**
     * Create new cell and cellMatrix it to machine.
     */
    public function defineMachine()
    {
        $vendingMachine = new VendingMachine();
        $cellDAO = new CellDAO();
        $cellMatrix = [];
        for ($row = 0; $row < $this->rowNumber; $row++) {
            for ($column = 0; $column < $this->columnNumber; $column++) {
                $cellId = $cellDAO->insert([$this->machineId, $row, $column]);
                $cellMatrix[$row][$column] = new Cell($this->cellSize, $cellId);
            }
        }
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
            $this->cellSize = $machineData['vendingMachineSize'];
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
     * Returns machine id.
     *
     * @return mixed
     */
    public function getMachineId()
    {
        return $this->machineId;
    }

    /**
     * Sets machine id.
     *
     * @param mixed $machineId
     */
    public function setMachineId($machineId): void
    {
        $this->machineId = $machineId;
    }


    /**
     * @return mixed
     */
    public function getRowNumber()
    {
        return $this->rowNumber;
    }

    /**
     * @param mixed $rowNumber
     */
    public function setRowNumber($rowNumber): void
    {
        $this->rowNumber = $rowNumber;
    }

    /**
     * @return mixed
     */
    public function getColumnNumber()
    {
        return $this->columnNumber;
    }

    /**
     * @param mixed $columnNumber
     */
    public function setColumnNumber($columnNumber): void
    {
        $this->columnNumber = $columnNumber;
    }

    /**
     * @return mixed
     */
    public function getCellMatrix()
    {
        return $this->cellMatrix;
    }

    /**
     * @param mixed $cellMatrix
     */
    public function setCellMatrix($cellMatrix): void
    {
        $this->cellMatrix = $cellMatrix;
    }

    /**
     * @return mixed
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * @param mixed $machineName
     */
    public function setMachineName($machineName): void
    {
        $this->machineName = $machineName;
    }

    /**
     * @return mixed
     */
    public function getMachineDesc()
    {
        return $this->machineDesc;
    }

    /**
     * @param mixed $machineDesc
     */
    public function setMachineDesc($machineDesc): void
    {
        $this->machineDesc = $machineDesc;
    }

    /**
     * @return mixed
     */
    public function getMachineStatus()
    {
        return $this->machineStatus;
    }

    /**
     * @param mixed $machineStatus
     */
    public function setMachineStatus($machineStatus): void
    {
        $this->machineStatus = $machineStatus;
    }

    /**
     * @return mixed
     */
    public function getMachineActiveDays()
    {
        return $this->machineActiveDays;
    }

    /**
     * @param mixed $machineActiveDays
     */
    public function setMachineActiveDays($machineActiveDays): void
    {
        $this->machineActiveDays = $machineActiveDays;
    }

    /**
     * @param $row
     * @param $column
     * @return mixed
     */
    public function getCell($row, $column)
    {
        return $this->cellMatrix[$row][$column];
    }
}
