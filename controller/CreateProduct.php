<?php

namespace vending;

include_once __DIR__ . '/../model/Chips.php';
include_once __DIR__ . '/../model/Cola.php';
include_once __DIR__ . '/../model/Snikers.php';

class CreateProduct
{

    public function createProducts()
    {
        if (isset($_POST)) {
            $productArray = [];
            $date = new \DateTime();
            for ($x = 0; $x < (count($_POST) - 2) / 4; $x++) {
                if (0 < ($_POST["productCounter$x"])) {
                    for ($y = 0; $y < $_POST["productCounter$x"]; $y++) {
                        $htmlDate = array_map(function ($v) {
                            return (int)$v;
                        }, explode('-', $_POST["productExpireDate$x"]));
                        switch ($_POST["productName$x"]) {
                            case "Cola":
                                $productOBJ = new Cola($_POST["productPrice$x"], $date->setDate($htmlDate[2], $htmlDate[1], $htmlDate[0]));
                                break;
                            case "Chips":
                                $productOBJ = new Chips($_POST["productPrice$x"], $date->setDate($htmlDate[2], $htmlDate[1], $htmlDate[0]));
                                break;
                            case "Snikers":
                                $productOBJ = new Snikers($_POST["productPrice$x"], $date->setDate($htmlDate[2], $htmlDate[1], $htmlDate[0]));
                                break;
                        }

                        $productArray[] = $productOBJ;
                    }
                }
            }
            $machine = new VendingMachine();
            $machine->loadMachine($_POST['machineId']);
            $machine->loadProducts($productArray);
        }
    }
}

