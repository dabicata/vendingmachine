<?php

include_once __DIR__ . '/../controller/Machine.php';
include_once __DIR__ . '/../controller/Product.php';
include_once __DIR__ . '/../model/VendingMachine.php';

session_start();
if (!isset($_GET['action'])) {
    $action = 'default';
} else {
    $action = $_GET['action'];
}
$object = new \vending\controller\Machine();

switch ($action) {

    case 'loadMachineView':
        $array = $object->loadProducts();
        $result = $object->loadMachine();
        $include = '../view/loadMachine.php';
        break;
    case 'editMachine':
        $object->editMachine();
        break;
    case 'createMachineView':
        $array = $object->createMachine();
        $include = '../view/createMachine.php';
        break;
    case 'editMachineView':
        $machineData = $object->editMachineView();
        $include = '../view/editMachine.php';
        break;
    case 'displayMachineView':
        $machineData = $object->displayMachine();
        $include = '../view/machine.php';
        break;
    case 'default':
        $include = '../view/index.php';
        break;
    default:
        $include = '../view/index.php';
}
include '../view/header.php';
include $include;
include '../view/footer.php';
