<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 11/20/17
 * Time: 2:55 PM
 */

namespace vending;

use vending\model\MachineDAO;
use vending\model\ProductTypeDAO;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/ProductTypeDAO.php';
include_once __DIR__ . '/../model/VendingMachine.php';
include_once __DIR__ . '/../model/Chips.php';
include_once __DIR__ . '/../model/Cola.php';
include_once __DIR__ . '/../model/Snikers.php';
include_once __DIR__ . '/../model/ProductCounter.php';


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

    }

    public function createMachine()
    {
        if (isset($_POST)) {
            if (($_POST['machineRows'] > 0) && ($_POST['machineColumns'] > 0) && ($_POST['machineSize'] > 0)) {
                $machine = new VendingMachine();
                $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize']);
            }
        }
    }

    public function editMachineView()
    {

        $machine = new MachineDAO();
        $machineDB = $machine->select([$_GET['machineId']]);

        return $machineDB;
    }

    public function displayMachine()
    {
        $machine = new MachineDAO();
        $machineDB = $machine->selectAll();

        return $machineDB;
    }

    public function loadMachine()
    {
        $machine = new MachineDAO();
        $machineDB = $machine->selectAll();
        $productTypes = new ProductTypeDAO();
        $productTypesArray = $productTypes->selectAll();
        $result = [$machineDB, $productTypesArray];

        return $result;
    }
}

