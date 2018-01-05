<?php


namespace vending\controller;


use vending\model\DAO\ActiveDaysDAO;
use vending\model\DAO\DaysDAO;
use vending\model\DAO\MachineDAO;
use vending\model\DAO\ProductTypeDAO;
use vending\model\DAO\StatusDAO;
use vending\model\VendingMachine;

include_once __DIR__ . '/../model/DAO/MachineDAO.php';
include_once __DIR__ . '/../model/DAO/ActiveDaysDAO.php';
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
    /**
     * Checks if the input form is valid and if it's valid edit's the machine, otherwise returns you to the form.
     *
     * @return mixed
     */
    public static function editMachine()
    {
        var_dump($_POST);
        $machine = new MachineDAO();
        $activeDaysDB = new ActiveDaysDAO();
        if (isset($_GET['machineId'])) {
            $array['checkedDays'] = $activeDaysDB->selectAllById([$_GET['machineId']]);
        } else {
            $array['checkedDays'] = $activeDaysDB->selectAllById([$_POST['vendingMachineId']]);
        }
        $array['days'] = Machine::machineDaysView();
        if (isset($_GET['machineId'])) {
            $array['machineData'] = $machine->select([$_GET['machineId']]);
        } else {
            $array['machineData'] = $machine->select([$_POST['vendingMachineId']]);
        }
        $array['status'] = Machine::machineStatusView();
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

                if (isset($_POST['machineStatus'])) {
                    if (($_POST['machineStatus'] > 0) && ($_POST['machineStatus'] != '') && ctype_digit($_POST['machineStatus'])) {
                        $statusDb = new StatusDAO();
                        $data = $statusDb->select([$_POST['machineStatus']]);
                        if (!empty($data)) {
                            $checks[] = true;
                            $validValues['validStatus'] = $_POST['machineStatus'];
                        } else {
                            $checks[] = false;
                            $invalidValues['invalidStatusRed'] = true;
                            $invalidValues['invalidStatus'] = $_POST['machineStatus'];
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
            $machine->update(array($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize'],
                $_POST['machineStatus'], $_POST['machineName'], $_POST['vendingMachineId']));
            $activeDaysDB->delete([$_POST['vendingMachineId']]);
            foreach ($_POST['days'] as $dayId) {
                $activeDaysDB->insert([$_POST['vendingMachineId'], $dayId]);
            }
//            header('location: index.php?action=displayMachineView   ');
        } else {
            if (isset($validValues) && isset($invalidValues)) {
                $array['validValues'] = $validValues;
                $array['invalidValues'] = $invalidValues;
            }

            return $array;
        }

        return $array;
    }


    /**
     * Checks if the input form is valid and if it's valid creates the machine, otherwise returns you to the form.
     *
     * @return mixed
     */
    public static function createMachine()
    {

        $array['days'] = Machine::machineDaysView();
        $array['status'] = Machine::machineStatusView();
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

                if (isset($_POST['machineStatus'])) {
                    if (($_POST['machineStatus'] > 0) && ($_POST['machineStatus'] != '') && ctype_digit($_POST['machineStatus'])) {
                        $statusDb = new StatusDAO();
                        $data = $statusDb->select([$_POST['machineStatus']]);
                        if (!empty($data)) {
                            $checks[] = true;
                            $validValues['validStatus'] = $_POST['machineStatus'];
                        } else {
                            $checks[] = false;
                            $invalidValues['invalidStatusRed'] = true;
                            $invalidValues['invalidStatus'] = $_POST['machineStatus'];
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
            $machine->createMachine($_POST['machineRows'], $_POST['machineColumns'], $_POST['machineSize'], $_POST['machineName'], $_POST['machineDesc'], $_POST['machineStatus'], $_POST['days']);
            header('location: index.php?action=loadMachineView');
            $array['validValues'] = null;
            $array['invalidValues'] = null;
        } else {
            if (isset($validValues) && isset($invalidValues)) {
                $array['validValues'] = $validValues;
                $array['invalidValues'] = $invalidValues;
            }
            return $array;
        }
    }


    /**
     * Displays machine status in input form.
     *
     * @return array
     */
    public static function displayMachine()
    {

        $counter = 0;
        $machine = new MachineDAO();
        $status = new StatusDAO();
        $days = new ActiveDaysDAO();
        $machineData['machineData'] = $machine->selectAll();
        foreach ($machineData['machineData'] as $machine) {
            $statusData = $status->select([$machine['vendingMachineStatusId']]);
            $daysData = $days->selectAllById([$machine['vendingMachineId']]);
            $machineData['machineData'][$counter]['vendingMachineDays'] = $daysData;
            $machineData['machineData'][$counter++]['vendingMachineStatus'] = $statusData['status'];
        }
        $machineData['daysList'] = machine::machineDaysView();

        return $machineData;
    }

    /**
     * Displays Machine Id and Products type in input form.
     *
     * @return array
     */
    public static function loadMachine()
    {
        $machine = new MachineDAO();
        $machineData = $machine->selectAll();
        $productTypes = new ProductTypeDAO();
        $productTypesArray = $productTypes->selectAll();
        $result = ['machineData' => $machineData, 'productType' => $productTypesArray];

        return $result;
    }

    /**
     * Calls createProduct method from Product class that creates products and then loads them in the machine.
     * @return mixed
     */
    public static function loadProducts()
    {

        $result = Product::createProducts();
        if ($result['productArray'] != null) {
            $machine = new VendingMachine();
            $machine->loadMachine($_POST['machineId']);
            $machine->loadProducts($result['productArray']);
            header('location: index.php?action=displayMachineView');
        }

        return $result['values'];
    }

    /**
     * Gets all statues from db and returns them.
     *
     * @return array|StatusDAO
     */
    public static function machineStatusView()
    {
        $status = new StatusDAO();
        $status = $status->selectAll();

        return $status;
    }

    /**
     * Gets all week days from db and returns them.
     *
     * @return array
     */
    public static function machineDaysView()
    {
        $daysDb = new DaysDAO();
        $daysData = $daysDb->selectAll();

        return $daysData;
    }
}

