<?php

namespace vending;

include 'VendingMachine.php';
include 'Cell.php';
include 'Product.php';
include 'Cola.php';
include 'Snikers.php';
include 'Chips.php';


$machines = 5;
$machineRow = 1;
$machineColumn = 2;
$cellSize = 10;
$productsNumber = 66;
$date = new \DateTime();
$productArray = [];

$expireDate = ['1' => $date->setDate(2017, 10, 15), '2' => $date->setDate(2017, 10, 21), '3' => $date->setDate(2017, 10, 25)];


for ($x = 0; $x < $productsNumber; $x++) {
    $rand = rand(1, 3);
    switch ($rand) {
        case 1:
            $productArray[] = new Cola(3, $expireDate[$rand]);
            break;
        case 2:
            $productArray[] = new Chips(5, $expireDate[$rand]);
            break;
        case 3:
            $productArray[] = new Snikers(6, $expireDate[$rand]);
            break;
    }

}
for ($i = 0; $i < $machines; $i++) {
    $machineClass[] = new VendingMachine($machineRow, $machineColumn, $cellSize);
}

foreach ($machineClass as $machine) {
    if ($productArray == !null) {
        $productArray = $machine->loadProducts($productArray);
        $machine->listItems();
        echo "\n ";
        die();

    }
}





