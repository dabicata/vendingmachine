<?php

namespace vending;

include_once __DIR__ . '/CreateMachine.php';
include_once __DIR__ . '/CreateProduct.php';
switch ($_POST["action"]) {
    case "createProduct":
        $object = new CreateProduct();
        $object->createProducts();
        break;
    case "createMachine":
        $object = new CreateMachine();
        $object->generateMachine();
        break;
}