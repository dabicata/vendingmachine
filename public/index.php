<?php

namespace vending;

include_once __DIR__ . '/../controller/Machine.php';
include_once __DIR__ . '/../controller/CreateProduct.php';
include_once __DIR__ . '/../model/VendingMachine.php';

include '../View/header.php';
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
        include '../View/LoadMachine.php';
        break;
    case "createMachineView":
        include '../View/CreateMachine.php';
        break;
    case "editMachineView":
        $object = new Machine();
        $machineDB = $object->editMachineView();
        include '../View/EditMachine.php';
        break;
    case "displayMachineView":
        $object = new Machine();
        $machineDB = $object->displayMachine();
        include '../View/Machine.php';
        break;
    case "default":
        include '../View/index.php';
        break;
    default:
        include '../View/index.php';
}
include '../View/footer.php';