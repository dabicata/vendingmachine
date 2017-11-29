<?php

namespace vending;

include_once __DIR__ . '/../controller/Machine.php';
include_once __DIR__ . '/../controller/CreateProduct.php';
include_once __DIR__ . '/../model/VendingMachine.php';

include '../view/header.php';
if (!isset($_GET["action"])) {
    $_GET["action"] = 'default';
}
switch ($_GET["action"]) {

    case "loadMachine":
        $object = new CreateProduct();
        $object->createProducts();
        break;
    case "createMachine":
        $object = new Machine();
        $object->createMachine();
        break;
    case "editMachine":
        $object = new Machine();
        $object->editMachine();
        break;
    case "loadMachineView":
        $object = new Machine();
        $result = $object->loadMachine();
        include '../view/loadMachine.php';
        break;
    case "createMachineView":
        include '../view/createMachine.php';
        break;
    case "editMachineView":
        $object = new Machine();
        $machineData = $object->editMachineView();
        include '../view/editMachine.php';
        break;
    case "displayMachineView":
        $object = new Machine();
        $machineData = $object->displayMachine();
        include '../view/machine.php';
        break;
    case "default":
        include '../view/index.php';
        break;
    default:
        include '../view/index.php';
}
include '../view/footer.php';