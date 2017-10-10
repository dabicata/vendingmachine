<?php

namespace vending;

include 'VendingMachine.php';
include 'Cell.php';
include 'Product.php';
include 'Cola.php';


$products1 = new cola(5, '3.10.17');
$products2 = new cola(5, '3.10.17');
$products3 = new cola(5, '3.10.17');
$products4 = new cola(5, '3.10.17');
$products5 = new cola(5, '15.10.17');
$products6 = new cola(5, '17.10.17');
$products7 = new cola(5, '15.10.17');
$products8 = new cola(5, '15.10.17');
$products9 = new cola(5, '3.10.17');
$products10 = new cola(5, '15.10.17');



$b = new VendingMachine (2, 4, 120);
$b->defineMachine();
$b->loadProduct2(array($products1, $products2, $products3, $products4, $products5, $products6, $products7, $products8, $products9, $products10));
$b->listItems();
$b->removeExpiredProducts();
$b->buyProduct(1, 1, 3);
$b->listItems();


