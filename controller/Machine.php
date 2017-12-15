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
        $checks = [];
        if (isset($_POST)) {
            if (($_POST['machineRows'] != '') || ($_POST['machineColumns'] != '') || ($_POST['machineSize'] != '')) {

                if (($_POST['machineRows'] > 0) && ($_POST['machineRows'] != '')) {
                    $checks[] = true;
                    $validValues['validRowsEdit'] = $_POST['machineRows'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidRowsEditRed'] = true;
                    $invalidValues['invalidRowsEdit'] = $_POST['machineRows'];
                }

                if (($_POST['machineColumns'] > 0) && ($_POST['machineColumns'] != '')) {
                    $checks[] = true;
                    $validValues['validColumnsEdit'] = $_POST['machineColumns'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidColumnsEditRed'] = true;
                    $invalidValues['invalidColumnsEdit'] = $_POST['machineColumns'];
                }
                if (($_POST['machineSize'] > 0) && ($_POST['machineSize'] != '')) {
                    $checks[] = true;
                    $validValues['validSizeEdit'] = $_POST['machineSize'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidSizeEditRed'] = true;
                    $invalidValues['invalidSizeEdit'] = $_POST['machineSize'];
                }
            }
        }
        if (!in_array(false, $checks) && ($checks != null)) {
            $machineRows = $_POST['machineRows'];
            $machineColumns = $_POST['machineColumns'];
            $machineSize = $_POST['machineSize'];
            $machineId = $_POST['vendingMachineId'];
            $machine = new MachineDAO();
            $machine->update(array($machineRows, $machineColumns, $machineSize, $machineId));
            header('location: index.php?action=displayMachineView');
        } else {
            $_SESSION['validValues'] = $validValues;
            $_SESSION['invalidValues'] = $invalidValues;
            $url = $_POST['vendingMachineId'];
            header("location: index.php?action=editMachineView&machineId=$url");
        }
    }


    public
    function createMachine()
    {
        $checks = [];
        if (isset($_POST)) {
            if (($_POST['machineRows'] != '') || ($_POST['machineColumns'] != '') || ($_POST['machineSize'] != '')) {

                if (($_POST['machineRows'] > 0) && ($_POST['machineRows'] != '') && ctype_digit($_POST['machineRows'])) {
                    $checks[] = true;
                    $validValues['validRows'] = $_POST['machineRows'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidRowsRed'] = true;
                    $invalidValues['invalidRows'] = $_POST['machineRows'];
                }

                if (($_POST['machineColumns'] > 0) && ($_POST['machineColumns'] != '') && ctype_digit($_POST['machineColumns'])) {
                    $checks[] = true;
                    $validValues['validColumns'] = $_POST['machineColumns'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidColumnsRed'] = true;
                    $invalidValues['invalidColumns'] = $_POST['machineColumns'];
                }
                if (($_POST['machineSize'] > 0) && ($_POST['machineSize'] != '') && ctype_digit($_POST['machineSize'])) {
                    $checks[] = true;
                    $validValues['validSize'] = $_POST['machineSize'];
                } else {
                    $checks[] = false;
                    $invalidValues['invalidSizeRed'] = true;
                    $invalidValues['invalidSize'] = $_POST['machineSize'];
                }
            }
        }
        if (!in_array(false, $checks) && ($checks != null)) {
            $machine = new VendingMachine();
            $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize']);
            header('location: index.php?action=loadMachineView');
            $_SESSION['validValues'] = null;
            $_SESSION['invalidValues'] = null;
        } else {
            $_SESSION['validValues'] = $validValues;
            $_SESSION['invalidValues'] = $invalidValues;
            header('location: index.php?action=createMachineView');
        }
    }


    public
    function editMachineView()
    {

        $machine = new MachineDAO();
        $machineData = $machine->select([$_GET['machineId']]);


        return $machineData;
    }

    public
    function displayMachine()
    {
        $machine = new MachineDAO();
        $machineData = $machine->selectAll();

        return $machineData;
    }

    public
    function loadMachine()
    {
        $machine = new MachineDAO();
        $machineData = $machine->selectAll();
        $productTypes = new ProductTypeDAO();
        $productTypesArray = $productTypes->selectAll();
        $result = ['machineData' => $machineData, 'productType' => $productTypesArray];

        return $result;
    }

    public
    function loadProducts($productArray)
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

