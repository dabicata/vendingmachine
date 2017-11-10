<?php

namespace vending;

include_once __DIR__ . '/Chips.php';
include_once __DIR__ . '/Cola.php';
include_once __DIR__ . '/Snikers.php';

class CreateProduct
{

    public function createProducts()
    {
        for ($x = 0; $x < (count($_POST) - 1) / 4; $x++) {
            if (0 < ($_POST["productCounter$x"])) {
                for ($y = 0; $y < $_POST["productCounter$x"]; $y++) {
                    switch ($_POST["productName$x"]) {
                        case "Cola":
                            $productOBJ = new Cola($_POST["productPrice$x"], $_POST["productExpireDate$x"]);
                            break;
                        case "Chips":
                            $productOBJ = new Chips($_POST["productPrice$x"], $_POST["productExpireDate$x"]);
                            break;
                        case "Snikers":
                            $productOBJ = new Snikers($_POST["productPrice$x"], $_POST["productExpireDate$x"]);
                            break;
                    }
                    $productArray[] = $productOBJ;
                }
            }
        }
        var_dump($productArray);
        return $productArray;
    }
}

