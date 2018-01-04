<?php

include_once __DIR__ . '/../controller/Machine.php';
include_once __DIR__ . '/../controller/Product.php';
include_once __DIR__ . '/../model/VendingMachine.php';

if (!isset($_GET['action'])) {
    $action = 'default';
} else {
    $action = $_GET['action'];
}

switch ($action) {
        //creates products and loads them in machine.
    case 'loadMachineView':
        $array = \vending\controller\Machine::loadProducts();
        $result = \vending\controller\Machine::loadMachine();
        $include = '../view/loadMachine.php';
        break;
        //Create machine.
    case 'createMachineView':
        $array = \vending\controller\Machine::createMachine();
        $include = '../view/createMachine.php';
        break;
        //Edit machine.
    case 'editMachineView':
        $array = \vending\controller\Machine::editMachine();
        $include = '../view/editMachine.php';
        break;
        //Display machine.
    case 'displayMachineView':
        $machineData = \vending\controller\Machine::displayMachine();
        $include = '../view/machine.php';
        break;
        //If url is invalid redirects you to the index page.
    case 'default':
        $include = '../view/index.php';
        break;
    //If url is invalid redirects you to the index page.
    default:
        $include = '../view/index.php';
}
include '../view/header.php';
include "$include";
include '../view/footer.php';
