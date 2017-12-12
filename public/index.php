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
switch ($action) {
    case 'loadMachineView':
        $object = new \vending\controller\Machine();
        $result = $object->loadMachine();
        $include = '../view/loadMachine.php';
        break;
    case 'loadMachine':
        $object = new \vending\controller\Product();
        $machine = new \vending\controller\Machine();
        $values = $object->createProducts();
        $machine->loadProducts($values['productArray']);
        break;
    case 'createMachine':
        $object = new \vending\controller\Machine();
        $object->createMachine();
        break;
    case 'editMachine':
        $object = new \vending\controller\Machine();
        $object->editMachine();
        break;
    case 'createMachineView':
        $include = '../view/createMachine.php';
        break;
    case 'editMachineView':
        $object = new \vending\controller\Machine();
        $machineData = $object->editMachineView();
        $include = '../view/editMachine.php';
        break;
    case 'displayMachineView':
        $object = new \vending\controller\Machine();
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
