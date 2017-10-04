<?php

namespace vending;

/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/108/17
 * Time: 5:36 PM
 */
include 'VendingMachine.php';
include 'Cell.php';
include 'Product.php';


$products1 = new Product('pizza1', '10', 2018);
$products2 = new Product('pizza2', '10', 2018);
$products3 = new Product('pizza3', '15', 2018);
$products4 = new Product('pizza4', '25', 2018);
$products5 = new Product('pizza5', '40', 2018);
$products6 = new Product('pizza6', '10', 2018);
$products7 = new Product('pizza7', '10', 2018);
$products8 = new Product('pizza8', '10', 2018);
$products9 = new Product('pizza9', '10', 2018);
$products10 = new Product('pizza10', '10', 2018);
$products11 = new Product('pizza11', '10', 2018);
$products12 = new Product('pizza12', '3', 2018);
$products = array($products1, $products1, $products1);
$products2 = array($products2, $products2, $products2);
$b = new VendingMachine (2, 2, 100);
$b->defineMachine();
$b->loadProduct(array($products, $products2));
