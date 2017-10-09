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
include 'Cola.php';


$products1 = new cola(5, "15.10.17");
$products2 = new cola(5, "15.10.17");


$b = new VendingMachine (2, 4, 120);
$b->defineMachine();
$b->loadProduct2(array($products1, $products2));
$b->listItems();
$b->buyProduct(0, 0, 6);

$b->listItems();
