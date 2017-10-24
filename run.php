<?php

namespace vending;

include '/srv/http/vendingmachine/controller/VendingMachine.php';
include '/srv/http/vendingmachine/controller/Chips.php';
include '/srv/http/vendingmachine/controller/Cola.php';
include '/srv/http/vendingmachine/controller/Snikers.php';
$machines = 1;
$machineRow = 3;
$machineColumn = 3;
$cellSize = 10;
$productsNumber = 500;
$date = new \DateTime();
$productArray = [];

$expireDate = ['1' => $date->setDate(2017, 5, 23), '2' => $date->setDate(2017, 12, 21), '3' => $date->setDate(2017, 12, 29)];

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


    }
}

//$machineClass[0]->removeExpiredProduct();



