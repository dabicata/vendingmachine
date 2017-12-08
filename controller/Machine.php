<?php


namespace vending\controller;


use vending\model\DAO\MachineDAO;
use vending\model\DAO\ProductTypeDAO;
use vending\model\VendingMachine;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/ProductTypeDAO.php';
include_once __DIR__ . '/../model/VendingMachine.php';
include_once __DIR__ . '/../model/Chips.php';
include_once __DIR__ . '/../model/Cola.php';
include_once __DIR__ . '/../model/Snikers.php';


class Machine
{
    public function editMachine()
    {

        $machineRows = $_POST['machineRows'];
        $machineColumns = $_POST['machineColumns'];
        $machineSize = $_POST['machineSize'];
        $machineId = $_POST['vendingMachineId'];
        $machine = new MachineDAO();
        $machine->update(array($machineRows, $machineColumns, $machineSize, $machineId));
        header('location: index.php?action=displayMachineView');
    }

    public function createMachine()
    {

        if (isset($_POST)) {
            if (($_POST['machineRows'] > 0) && ($_POST['machineColumns'] > 0) && ($_POST['machineSize'] > 0)) {
                $machine = new VendingMachine();
                $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize']);
                header('location: index.php?action=loadMachineView');
            }
        }
    }

    public function editMachineView()
    {

        $machine = new MachineDAO();
        $machineData = $machine->select([$_GET['machineId']]);


        return $machineData;
    }

    public function displayMachine()
    {
        $machine = new MachineDAO();
        $machineData = $machine->selectAll();

        return $machineData;
    }

    public function loadMachine()
    {
        $machine = new MachineDAO();
        $machineData = $machine->selectAll();
        $productTypes = new ProductTypeDAO();
        $productTypesArray = $productTypes->selectAll();
        $result = ['machineData' => $machineData, 'productType' => $productTypesArray];

        return $result;
    }

    public function loadProducts($productArray)
    {
        var_dump($productArray != null);
        if ($productArray != null) {
            $machine = new VendingMachine();
            $machine->loadMachine($_POST['machineId']);
            $machine->loadProducts($productArray);
            header('location: index.php?action=displayMachineView');
        }
    }
}

