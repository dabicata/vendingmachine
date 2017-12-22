<?php


namespace vending\controller;


use vending\model\DAO\DaysDAO;
use vending\model\DAO\MachineDAO;
use vending\model\DAO\ProductTypeDAO;
use vending\model\DAO\StatusDAO;
use vending\model\VendingMachine;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/ProductTypeDAO.php';
include_once __DIR__ . '/../model/DAO/StatusDAO.php';
include_once __DIR__ . '/../model/DAO/DaysDAO.php';
include_once __DIR__ . '/../model/VendingMachine.php';
include_once __DIR__ . '/../model/Chips.php';
include_once __DIR__ . '/../model/Cola.php';
include_once __DIR__ . '/../model/Snikers.php';
include_once __DIR__ . '/Product.php';


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
            $array['validValues'] = $validValues;
            $array['invalidValues'] = $invalidValues;
            $url = $_POST['vendingMachineId'];
            header("location: index.php?action=editMachineView&machineId=$url");
        }
    }


    public function createMachine()
    {
        $array['days'] = $this->machineDaysView();
        $array['status'] = $this->machineStatusView();
//        $array['status'] = $status;
        $array['days'];
//        var_dump($_POST);
        $checks = [];
        if (!empty($_POST)) {
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
                if (trim($_POST['machineDesc']) != '') {
                    $checks[] = true;
                    $validValues['validDesc'] = trim(htmlentities($_POST['machineDesc']));
                } else {
                    $checks[] = false;
                    $invalidValues['invalidDescRed'] = true;
                    $invalidValues['invalidDesc'] = trim(htmlentities($_POST['machineDesc']));
                }
                if (trim($_POST['machineName']) != '') {
                    $checks[] = true;
                    $validValues['validName'] = trim(htmlentities($_POST['machineName']));
                } else {
                    $checks[] = false;
                    $invalidValues['invalidNameRed'] = true;
                    $invalidValues['invalidName'] = trim(htmlentities($_POST['machineName']));
                }
                if (isset($_POST['status'])) {
                    if (($_POST['status'] > 0) && ($_POST['status'] != '') && ctype_digit($_POST['status'])) {
                        $statusDb = new StatusDAO();
                        $data = $statusDb->select([$_POST['status']]);
                        if (!empty($data)) {
                            $checks[] = true;
                            $validValues['validStatus'] = $_POST['status'];
                        } else {
                            $checks[] = false;
                            $invalidValues['invalidStatusRed'] = true;
                            $invalidValues['invalidStatus'] = $_POST['status'];
                        }
                    }
                } else {
                    $checks[] = false;
                    $invalidValues['invalidStatusRed'] = true;
                    $validValues['invalidStatus'] = '';
                }
                $validValues['validDays'] = [];
                if (isset($_POST['days'])) {
                    foreach ($_POST['days'] as $day) {
                        if (($day > 0) && ($day != '') && ctype_digit($day)) {
                            $daysDb = new DaysDAO();
                            $data = $daysDb->select([$day]);
                            if (!empty($data)) {
                                var_dump($day);
                                $checks[] = true;
                                $validValues['validDays'][] = $day;
                            } else {
                                $checks[] = false;
                                $invalidValues['invalidDaysRed'] = true;
                            }
                        } else {
                            $checks[] = false;
                            $invalidValues['invalidDaysRed'] = true;
                        }
                    }
                } else {
                    $checks[] = false;
                    $invalidValues['invalidDaysRed'] = true;
                }
            }
        }

        if (!in_array(false, $checks) && ($checks != null)) {
            $machine = new VendingMachine();
            $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize']);
            header('location: index.php?action=loadMachineView');
            $array['validValues'] = null;
            $array['invalidValues'] = null;
        } else {
            if (isset($validValues) && isset($invalidValues)) {
                $array['validValues'] = $validValues;
                $array['invalidValues'] = $invalidValues;
            }
            return $array;
//            header('location: index.php?action=createMachineView');
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
    function loadProducts()
    {
        $object = new Product();
        $result = $object->createProducts();
        if ($result['productArray'] != null) {
            $machine = new VendingMachine();
            $machine->loadMachine($_POST['machineId']);
            $machine->loadProducts($result['productArray']);
            header('location: index.php?action=displayMachineView');
        } else {
            echo 'bababababab';
        }
//        var_dump($result['values']);
//        die;
        return $result['values'];
    }

    public
    function machineStatusView()
    {
        $status = new StatusDAO();
        $status = $status->selectAll();

        return $status;
    }

    public
    function machineDaysView()
    {
        $daysDb = new DaysDAO();
        $daysData = $daysDb->selectAll();

        return $daysData;
    }
}

